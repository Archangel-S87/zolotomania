<?php
require_once 'autoload.php';
require_once 'YandexMoneyLogger.php';

if (!date_default_timezone_get()) {
    date_default_timezone_set('Europe/Moscow');
}

use YandexCheckout\Client;
use YandexCheckout\Model\Notification\NotificationFactory;
use YandexCheckout\Model\PaymentStatus;
use YandexCheckout\Request\Payments\Payment\CreateCaptureRequest;
use YandexMoneyModule\KassaSecondReceiptModel;
use YandexMoneyModule\YandexMoneyLogger;

class YandexMoneyCallbackHandler
{
    public $simplaApi;

    /**
     * YandexMoneyCallbackHandler constructor.
     * @param $simplaApi
     */
    public function __construct($simplaApi)
    {
        $this->simplaApi = $simplaApi;
    }

    /**
     * @throws Exception
     */
    public function processReturnUrl()
    {
        $orderId       = $this->simplaApi->request->get('order');
        $order         = $this->simplaApi->orders->get_order(intval($orderId));
        $paymentMethod = $this->simplaApi->payment->get_payment_method(intval($order->payment_method_id));
        $settings      = $this->simplaApi->payment->get_payment_settings($paymentMethod->id);
        $apiClient     = $this->getApiClient($settings['yandex_api_shopid'], $settings['yandex_api_password'], $settings['ya_kassa_debug']);
        $paymentId     = $this->getPaymentId($orderId);
        $logger        = new YandexMoneyLogger($settings['ya_kassa_debug']);
        $apiClient->setLogger($logger);
        try {
            $paymentInfo = $apiClient->getPaymentInfo($paymentId);
            if ($paymentInfo->status == PaymentStatus::WAITING_FOR_CAPTURE) {
                $captureResult = $this->capturePayment($apiClient, $paymentInfo);
                if ($captureResult->status == PaymentStatus::SUCCEEDED) {
                    $this->completePayment($order, $paymentId);
                    $logger->info('Complete payment #'.$paymentId.' orderId: '.$orderId);
                } else {
                    $logger->info('Capture order fail. OrderId: '.$orderId);
                }
            } elseif ($paymentInfo->status == PaymentStatus::CANCELED) {
                $logger->info('Cancel order. OrderId: '.$orderId);
            } elseif ($paymentInfo->status == PaymentStatus::SUCCEEDED) {
                $this->completePayment($order, $paymentId);
                $logger->info('Complete payment #'.$paymentId.' orderId: '.$orderId);
            }

            $return_url = $this->simplaApi->config->root_url.'/order/'.$order->url;
            header('Location: '.$return_url);
            exit;
        } catch (Exception $e) {
            $logger->error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @throws \YandexCheckout\Common\Exceptions\ApiException
     * @throws \YandexCheckout\Common\Exceptions\BadApiRequestException
     * @throws \YandexCheckout\Common\Exceptions\ExtensionNotFoundException
     * @throws \YandexCheckout\Common\Exceptions\ForbiddenException
     * @throws \YandexCheckout\Common\Exceptions\InternalServerError
     * @throws \YandexCheckout\Common\Exceptions\NotFoundException
     * @throws \YandexCheckout\Common\Exceptions\ResponseProcessingException
     * @throws \YandexCheckout\Common\Exceptions\TooManyRequestsException
     * @throws \YandexCheckout\Common\Exceptions\UnauthorizedException
     */
    public function processNotification()
    {
        $body           = @file_get_contents('php://input');
        $callbackParams = json_decode($body, true);
        if (json_last_error()) {
            header("HTTP/1.1 400 Bad Request");
            header("Status: 400 Bad Request");
            exit();
        }

        $notificationFactory = new NotificationFactory();
        $notificationModel = $notificationFactory->factory($callbackParams);

        $payment       = $notificationModel->getObject();
        $orderId       = (int)$payment->getMetadata()->offsetGet('order_id');
        $order         = $this->simplaApi->orders->get_order(intval($orderId));
        $paymentMethod = $this->simplaApi->payment->get_payment_method(intval($order->payment_method_id));
        $settings      = $this->simplaApi->payment->get_payment_settings($paymentMethod->id);
        $apiClient     = $this->getApiClient($settings['yandex_api_shopid'], $settings['yandex_api_password'], $settings['ya_kassa_debug']);
        $logger        = new YandexMoneyLogger($settings['ya_kassa_debug']);
        $logger->info('Notification: '.$body);
        $apiClient->setLogger($logger);
        $paymentId = $payment->getId();
        if (!$order) {
            $logger->error('Order not found. OrderId: '.$orderId);
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            exit();
        }

        $paymentInfo = $apiClient->getPaymentInfo($payment->getId());
        if (empty($paymentInfo)) {
            $logger->error('Empty payment info. OrderId: '.$orderId);
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            exit();
        }

        switch ($paymentInfo->status) {
            case PaymentStatus::WAITING_FOR_CAPTURE:
                $captureResult = $this->capturePayment($apiClient, $paymentInfo);
                $logger->info('Capture payment #'.$paymentId.' orderId: '.$orderId);
                if ($captureResult->status === PaymentStatus::SUCCEEDED) {
                    $this->completePayment($order, $paymentId);
                    $logger->info('Complete payment #'.$paymentId.' orderId: '.$orderId);
                } else {
                    $logger->info('Capture order fail. OrderId: '.$orderId);
                }
                header("HTTP/1.1 200 OK");
                header("Status: 200 OK");
                break;
            case PaymentStatus::PENDING:
                $logger->info('Pending payment. OrderId: '.$orderId.' paymentId: '.$paymentId);
                header("HTTP/1.1 400 Bad Request");
                header("Status: 400 Bad Request");
                break;
            case PaymentStatus::SUCCEEDED:
                $this->completePayment($order, $paymentId);
                $logger->info('Complete payment #'.$paymentId.' orderId: '.$orderId);
                header("HTTP/1.1 200 OK");
                header("Status: 200 OK");
                break;
            case PaymentStatus::CANCELED:
                $logger->info('Cancel order. OrderId: '.$orderId);
                header("HTTP/1.1 200 OK");
                header("Status: 200 OK");
                break;
        }

        exit();
    }

    public function hookSendSecondReceipt($order)
    {
        $logger = new YandexMoneyLogger(1);
        $logger->info("Input order body = " . print_r($order, true));
        if (empty($order->id)) {
            $logger->error('order id is clean');
            return;
        }

        $paymentId = $this->getPaymentId($order->id);

        $this->sendSecondReceipt($order, $paymentId);
    }

    /**
     * @param $order
     * @param $paymentId
     * @throws \YandexCheckout\Common\Exceptions\ApiException
     * @throws \YandexCheckout\Common\Exceptions\BadApiRequestException
     * @throws \YandexCheckout\Common\Exceptions\ExtensionNotFoundException
     * @throws \YandexCheckout\Common\Exceptions\ForbiddenException
     * @throws \YandexCheckout\Common\Exceptions\InternalServerError
     * @throws \YandexCheckout\Common\Exceptions\NotFoundException
     * @throws \YandexCheckout\Common\Exceptions\ResponseProcessingException
     * @throws \YandexCheckout\Common\Exceptions\TooManyRequestsException
     * @throws \YandexCheckout\Common\Exceptions\UnauthorizedException
     */
    private function sendSecondReceipt($order, $paymentId)
    {
        $paymentMethod = $this->simplaApi->payment->get_payment_method(intval($order->payment_method_id));
        $settings      = $this->simplaApi->payment->get_payment_settings($paymentMethod->id);
        $apiClient     = $this->getApiClient($settings['yandex_api_shopid'], $settings['yandex_api_password'], $settings['ya_kassa_debug']);
        $logger        = new YandexMoneyLogger($settings['ya_kassa_debug']);

        try {
            $paymentInfo   = $apiClient->getPaymentInfo($paymentId);
        } catch (Exception $e) {
            $logger->error("Send second receipt fail, error: " . $e->getMessage());
            return;
        }

        $orderInfo = array(
            'orderId' => $order->id,
            'user_email' => $order->email,
            'user_phone' => $order->phone,
        );

        if (!$this->isNeedSecondReceipt($order, $settings)) {
            $logger->error("Second receipt isn't need");
            return;
        }

        $kassaSecondReceipt = new KassaSecondReceiptModel($paymentInfo, $orderInfo, $apiClient, $settings['ya_kassa_debug']);
        if ($kassaSecondReceipt->sendSecondReceipt()) {
            $sum = number_format($kassaSecondReceipt->getSettlementsSum(), 2, '.', ' ');
            $this->simplaApi->orders->update_order($order->id, array(
                'comment' => $order->comment . " Отправлен второй чек. Сумма " . $sum . " рублей.",
            ));
        }
    }

    /**
     * @param $order
     * @param $settings
     *
     * @return bool
     */
    private function isNeedSecondReceipt($order, $settings)
    {
        $logger = new YandexMoneyLogger($settings['ya_kassa_debug']);

        $logger->info(print_r($order, true));

        if (empty($settings['ya_kassa_api_send_check'])) {
            $logger->error('54 fz dont activate');
            return false;
        } elseif (empty($settings['ya_kassa_api_send_second_receipt'])) {
            $logger->error('send second receipt dont activate');
            return false;
        } elseif (empty($settings['ya_kassa_api_second_receipt_status'])) {
            $logger->error('Not selected second receipt status');
            return false;
        } elseif ($settings['ya_kassa_api_second_receipt_status'] != $order->status) {
            $logger->error('Incorrect order status, expected status = ' . $settings['ya_kassa_api_second_receipt_status']
                            . ' current status = ' . $order->status);
            return false;
        }

        return true;
    }

    /**
     * @param YandexCheckout\Client $apiClient
     * @param object $payment
     *
     * @return YandexCheckout\Request\Payments\Payment\CreateCaptureResponse
     * @throws \YandexCheckout\Common\Exceptions\ApiException
     * @throws \YandexCheckout\Common\Exceptions\BadApiRequestException
     * @throws \YandexCheckout\Common\Exceptions\ForbiddenException
     * @throws \YandexCheckout\Common\Exceptions\InternalServerError
     * @throws \YandexCheckout\Common\Exceptions\NotFoundException
     * @throws \YandexCheckout\Common\Exceptions\ResponseProcessingException
     * @throws \YandexCheckout\Common\Exceptions\TooManyRequestsException
     * @throws \YandexCheckout\Common\Exceptions\UnauthorizedException
     */
    protected function capturePayment($apiClient, $payment)
    {
        $captureRequest = CreateCaptureRequest::builder()->setAmount($payment->getAmount())->build();

        $result = $apiClient->capturePayment(
            $captureRequest,
            $payment->id
        );

        return $result;
    }

    /**
     * @param int|string $shopId
     * @param string $shopPassword
     * @param $logger
     *
     * @return Client
     */
    public function getApiClient($shopId, $shopPassword, $logger)
    {
        $yandexMoneyApi = new YandexMoneyApi();

        return $yandexMoneyApi->getApiClient($shopId, $shopPassword, $logger);
    }
    
	/**
     * @param $orderId
     * @return mixed
     */
    private function getPaymentId($orderId)
    {
        $sql   = 'SELECT o.payment_details FROM __orders AS o WHERE o.id='.$this->simplaApi->db->escape((int)$orderId);
        $query = $this->simplaApi->db->placehold($sql);
        $this->simplaApi->db->query($query);

        return $this->simplaApi->db->result('payment_details');
    }

	// Original from Yandex
    /*private function completePayment($order, $paymentId)
    {
        $this->simplaApi->orders->pay($order->id);
        $comment = $order->comment." Номер транзакции в Яндекс.Кассе: {$paymentId}. Сумма: {$order->total_price}";
        $this->simplaApi->orders->update_order($order->id, array(
            'paid'    => 1,
            'status'  => 1,
            'comment' => $comment,
        ));

        $this->simplaApi->notify->email_order_admin((int)$order->id);
    }*/
    
    private function completePayment($order, $paymentId)
    {
        // Ставим статус оплачен и начисляем баллы
        $this->simplaApi->orders->set_pay(intval($order->id));
        
        // Спишем товары  
		$this->simplaApi->orders->close(intval($order->id));

        // Отправляем уведомление администратору
        $this->simplaApi->notify->email_order_admin((int)$order->id);
        // Отправляем уведомление пользователю
        $this->simplaApi->notify->email_order_user((int)$order->id);
    }
}
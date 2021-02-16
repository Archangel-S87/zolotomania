<?php

/*
 * Документация https://pokupay.ru/documents
 *
 * Кабинет тестовый https://3dsec.sberbank.ru/mportal3
 * Вход T4632247232-credit-operator/T4632247232-credit
 * API T4632247232-credit-api/T4632247232-credit
 * ключ atmiumq7192mp5bob3p8u0189o
 *
 * Кабинет боевой https://securepayments.sberbank.ru/mportal3
 * Вход P4632247232-operator/*
 * API P4632247232-api/N2rfSA)GXM7q*vY
 */

require_once('api/Fivecms.php');

class SberbankCredit extends Fivecms
{
    const TEST_SERVER = 'https://3dsec.sberbank.ru/';
    const PROD_SERVER = 'https://securepayments.sberbank.ru/';

    const REGISTER = 'sbercredit/register.do';
    const STATUS = 'payment/rest/getOrderStatusExtended.do';
    const FORM = 'sbercredit/rbs-common.html';

    // Суффикс для подстановки в системе банка ордера
    const SUFFIX_ORDER = '_ref_credit_';

    private $order;
    private $payment_method;
    private $payment_settings;

    /**
     * @param $order_id
     * @return false|stdClass
     */
    public function set_order($order_id)
    {
        $this->order = $this->orders->get_order((int)$order_id);
        $this->payment_method = $this->payment->get_payment_method($this->order->payment_method_id);
        $this->payment_settings = $this->payment->get_payment_settings($this->payment_method->id);
        return $this->order;
    }

    public function checkout_form($order_id, $button_text = null, $print = true)
    {
        $this->set_order($order_id);

        $last_order = $this->get_last_order($order_id);

        if ($last_order) {
            // получаю статус в сбере
            $status = $this->get_order_status_extended($last_order->order_id . self::SUFFIX_ORDER . $last_order->trial);

            if (!$status) {
                $form_url = $this->register_order();
            } elseif (isset($status->orderStatus) && $status->orderStatus == 0) {
                // Ордер ожидает оплаты

                $url = ($this->payment_settings['test_server'] ? self::TEST_SERVER : self::PROD_SERVER) . self::FORM . '?mdOrder=' . htmlentities($last_order->order_sber);

                // Включение заглушки
                if ($this->payment_settings['test_server'] && $this->payment_settings['test_dummy']) {
                    $url .= '&dummy=true';
                }

                $form_url['url'] = $url;
            } elseif (isset($status->orderStatus) && $status->orderStatus == 6) {
                // Если просрочен регистрирую новый ордер
                $form_url = $this->register_order(++$last_order->trial);
            } else {
                // Вывести ошибку
                if (!$print) {
                    return "<p class='checkout_button'>{$status->actionCodeDescription}</p>";
                } else {
                    return $status->actionCodeDescription;
                }
            }
        } else {
            // Регистрирую ордер в сиситеме банка
            $form_url = $this->register_order();
        }

        if (!$print) {
            return $form_url;
        }

        if (!empty($form_url['error'])) {
            return "<p>{$form_url['error']}</p>";
        }
        $form_url = $form_url['url'];

        return "<a href='$form_url' class=checkout_button>Перейти к оплате</a>";
    }

    /**
     * Получает расширеный статус ордера в сбере
     * @param $order_sber string
     * @return false|stdClass
     */
    public function get_order_status_extended($order_sber)
    {
        $data = [
            'userName' => $this->payment_settings['login'],
            'password' => $this->payment_settings['pass'],
            'orderNumber' => $order_sber,
        ];

        $url = ($this->payment_settings['test_server'] ? self::TEST_SERVER : self::PROD_SERVER) . self::STATUS;

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $response = $this->request->curl_request($url, $data, true, $headers);

        if ($response['error']) return false;

        return json_decode($response['body']);
    }

    private function register_order($index = 0)
    {
        $price = $this->money->convert($this->order->total_price, $this->payment_method->currency_id, false);
        $delivery = $this->delivery->get_delivery($this->order->delivery_id);

        $user_data = [
            'Заказ' => $this->order->id,
            'Заказчик' => $this->order->name,
            'Телефон' => $this->order->phone,
            'Доставка' => $delivery->name,
        ];

        $orderBundle = [
            'cartItems' => [
                'items' => $this->get_cart_items($this->order->id)
            ],
            'installments' => [
                'productID' => 10,
                'productType' => $this->payment_settings['installments']
            ]
        ];

        $data = [
            'userName' => $this->payment_settings['login'],
            'password' => $this->payment_settings['pass'],
            'orderNumber' => $this->order->id . self::SUFFIX_ORDER . $index,
            'amount' => (int)($price * 100),
            'currency' => 643,
            'returnUrl' => "{$this->config->root_url}/order?orderId={$this->order->id}&after_payment=1",
            'failUrl' => "{$this->config->root_url}/order?orderId={$this->order->id}&bad_payment=1",
            'description' => "Оплата заказа №{$this->order->id}",
            'sessionTimeoutSecs' => 1,
            'jsonParams' => json_encode($user_data),
            'orderBundle' => json_encode($orderBundle)
        ];

        // Включение заглушки
        if ($this->payment_settings['test_server'] && $this->payment_settings['test_dummy']) {
            $data['dummy'] = true;
        }

        $url = ($this->payment_settings['test_server'] ? self::TEST_SERVER : self::PROD_SERVER) . self::REGISTER;

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $response = $this->request->curl_request($url, $data, true, $headers);

        if ($response['error']) {
            $this->notify->print_log(__DIR__, 'get_form.log', $response['error']);
            return ['error' => 'Try repeat!'];
        }

        $j_body = json_decode($response['body']);
        if (!$j_body) {
            $this->notify->print_log(__DIR__, 'get_form.log', $response['body']);
            $html = base64_encode($response['body']);
            $html = '<iframe src="data:text/html;base64,' . $html . '" width="100%"></iframe>';
            return ['error' => $html];
        } elseif ($j_body && (empty($j_body->orderId) || empty($j_body->formUrl))) {
            $this->notify->print_log(__DIR__, 'get_form.log', $response['body']);
            return ['error' => 'Ошибка'];
        }

        $this->save_register_order([
            'order_id' => (int)$this->order->id,
            'trial' => (int)$index,
            'order_sber' => $j_body->orderId
        ]);

        return ['url' => $j_body->formUrl];
    }

    /**
     * Формирование заказаных позиций
     * @param $order_id string
     * @return array
     */
    public function get_cart_items($order_id)
    {
        $exclude_name = ['\'', '&', '-', '#', '%', '|', ';', '='];
        $items = [];

        $purchases = $this->orders->get_purchases(['order_id' => (int)$order_id]);
        foreach ($purchases as $index => $purchase) {

            $price = (int)($purchase->price * 100);

            $item = [
                'positionId' => $index + 1,
                'name' => str_replace($exclude_name, '', $purchase->product_name),
                'quantity' => [
                    'value' => $purchase->amount,
                    'measure' => $purchase->unit
                ],
                'itemAmount' => $price,
                'itemPrice' => $price,
                'itemCode' => $purchase->product_external_id
            ];

            $items[] = $item;
        }

        return $items;
    }

    /**
     * Сохраняет в БД зарегистрированый в системе банка ордер
     * @param $data
     * @return int
     */
    private function save_register_order($data)
    {
        $query = $this->db->placehold("INSERT INTO __payments_sber SET ?%", $data);
        $this->db->query($query);
        return $this->db->insert_id();
    }

    /**
     * Возвращает последний зарегистрированы ордер из БД
     * @param $order_id
     * @return false|stdClass
     */
    private function get_last_order($order_id)
    {
        $this->db->query('SELECT * FROM __payments_sber WHERE order_id=? ORDER BY date_create DESC LIMIT 1', (int)$order_id);
        return $this->db->result();
    }
}

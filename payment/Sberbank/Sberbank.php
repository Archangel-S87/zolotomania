<?php

function print_file($data)
{
    $file_data = '';

    for ($i = 0; $i < 40; $i++) {
        if ($i == 21) {
            $file_data .= date('d-m-Y H:i:s');
        }
        $file_data .= '-';
    }

    $file_data .= PHP_EOL;

    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $file_data .= $key . '=' . $value . PHP_EOL;
        }
    } else {
        $file_data .= $data . PHP_EOL;
    }
    return file_put_contents(__DIR__ . '/callback.log', $file_data, FILE_APPEND);
}

require_once('api/Fivecms.php');

class Sberbank extends Fivecms
{
    const TEST_SERVER = 'https://3dsec.sberbank.ru/payment/rest/';
    const TEST_FORM = 'https://3dsec.sberbank.ru/payment/merchants/sbersafe_id/payment_ru.html';
    const PROD_SERVER = 'https://securepayments.sberbank.ru/payment/rest/';

    public function checkout_form($order_id)
    {
        $order = $this->orders->get_order((int)$order_id);
        $payment_method = $this->payment->get_payment_method($order->payment_method_id);
        $payment_settings = $this->payment->get_payment_settings($payment_method->id);

        $html = '';

        $orderId = '';
        $r = '{"orderId":"62ef71a3-0791-7703-b598-fc5f5e40ae9a","formUrl":"https://3dsec.sberbank.ru/payment/merchants/sbersafe_id/payment_ru.html?mdOrder=62ef71a3-0791-7703-b598-fc5f5e40ae9a"}';

        if ($order->order_id) {
            $form_url = self::TEST_FORM . '?mdOrder=' . htmlentities($order->order_id);
        } else {
            $form_url = $this->register_order($order, $payment_settings, $payment_method);
        }

        return "<form accept-charset='UTF-8' action='{$form_url}' method='GET'>" .
            "<input type=submit class=checkout_button value='Перейти к оплате'>" .
            "</form>";
    }

    private function register_order($order, $payment_settings, $payment_method)
    {
        $price = $this->money->convert($order->total_price, $payment_method->currency_id, false);
        $delivery = $this->delivery->get_delivery($order->delivery_id);

        $user_data = [
            'orderNumber' => $order->id,
            'Заказчик' => $order->name,
            'Телефон' => $order->phone,
            'Доставка' => $delivery->name
        ];

        $data = [
            'token' => $payment_settings['token_sber'],
            'orderNumber' => $order->id,
            'amount' => $price,
            'returnUrl' => "{$this->config->root_url}/payment/Sberbank/callback.php?id={$order->id}",
            'description' => "Оплата заказа №{$order->id}",
            'jsonParams' => json_encode($user_data)
        ];

        $url = $payment_settings['test_server'] ? self::TEST_SERVER : self::PROD_SERVER;
        $url .= "{$payment_settings['payment_method']}.do?";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type' => 'application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $temp_url = 'https://3dsec.sberbank.ru/payment/rest/register.do?token=55psnbbg3thon7g2jgd433vok4&orderNumber=44&amount=9390&returnUrl=http%3A%2F%2Fzolotomania.loc%2Fpayment%2FSberbank%2Fcallback.php%3Fid%3D44&description=%D0%9E%D0%BF%D0%BB%D0%B0%D1%82%D0%B0+%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0+%E2%84%9644&jsonParams=%7B%22orderNumber%22%3A%2244%22%2C%22%5Cu0417%5Cu0430%5Cu043a%5Cu0430%5Cu0437%5Cu0447%5Cu0438%5Cu043a%22%3A%22%5Cu041f%5Cu0440%5Cu043e%5Cu0431%5Cu0443%5Cu044e+%5Cu0431%5Cu0435%5Cu0437+%5Cu0430%5Cu0432%5Cu0442%5Cu043e%5Cu0440%5Cu0438%5Cu0437%5Cu0430%5Cu0446%5Cu0438%5Cu0438%22%2C%22%5Cu0422%5Cu0435%5Cu043b%5Cu0435%5Cu0444%5Cu043e%5Cu043d%22%3A%22%2B76666666666%22%2C%22%5Cu0414%5Cu043e%5Cu0441%5Cu0442%5Cu0430%5Cu0432%5Cu043a%5Cu0430%22%3A%22%5Cu0414%5Cu043e%5Cu043c%5Cu043e%5Cu0439%22%7D';

        $body = curl_exec($ch);
        $error = $body === false ? curl_error($ch) : false;
        curl_close($ch);

        if ($error) {
            print_file($error);
            // пишем в файл
            return false;
        }

        $j_body = json_decode($body);
        if (!$j_body || !$j_body->orderId || !$j_body->formUrl) {
            print_file($body);
            // пишем в файл
            // выводим ошибку
            return '';
        }

        $this->orders->update_order($order->id, ['order_id' => $j_body->orderId]);

        return $j_body->formUrl;
    }
}

// Метод
$method = $_GET['method'] ?? '';

$post = new stdClass();
$post->post_name = '';

// Агента
switch ($post->post_name) {
    case 'sberbank' :
        if ($method) {
            $url = send_sberbank();
            if ($url) wp_redirect($url, 301);
        } else if (
            isset($_GET['checksum']) && $_GET['status'] && $_GET['operation'] == 'deposited') {
            // Проверка оплаты
            if (check_hash_sberbank($_GET)) {
                $order_params = get_order_status_sberbank($_GET);
                if ($order_params) {
                    update_order_sberbank($order_params);
                }
            } else {
                $order_params = get_order_status_sberbank($_GET);
                if ($order_params) {
                    update_order_sberbank($order_params, false);
                }
                echo 'Неверная сумма!</br>';
                $_GET['error'] = 'Не верная сумма';
            }
            print_file('/getcourse/log/payments_sberbank.txt', $_GET);
        }
        exit;
        break;
}


function update_order_sberbank($order_params = array(), $is_dane = true)
{

    require_once get_template_directory() . '/getcourse/lib/autoload.php';

    foreach ($order_params['merchantOrderParams'] as $order_param) {
        switch ($order_param['name']) {
            case 'user_email' :
                $user_email = $order_param['value'];
                break;
            case 'product_title' :
                $product_title = $order_param['value'];
                break;
        }
    }

    $deal = new \GetCourse\Deal();

    $deal::setAccountName(get_field('getcourse_account_name', 'options'));
    $deal::setAccessToken(get_field('getcourse_access_token', 'options'));

    try {
        $result = $deal
            ->setProductTitle($product_title ?? '')
            ->setDealCost($order_params['amount'] ? (int)$order_params['amount'] / 100 : '')
            ->setEmail($user_email ?? '')
            ->setDealNumber($order_params['orderNumber'] ?? '')
            ->setDealStatus($is_dane ? 'В работе' : 'Ложный')
            ->setDealComment('Оплата картой через Сбербанк')
            ->setOverwrite()
            ->apiCall('add');
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $result = json_encode($result->result);
    print_file('/getcourse/log/update_order_getcourse.txt', $result);

}

function get_order_status_sberbank($args)
{

    $url = 'https://securepayments.sberbank.ru/payment/rest/getOrderStatusExtended.do';

    $data = array(
        'userName' => urlencode(get_field('sber_api_login', 'options')),
        'password' => urlencode(get_field('sber_api_password', 'options')),
        'orderId' => urlencode($args['mdOrder']),
        'orderNumber' => urlencode($args['orderNumber'])
    );

    $url = add_query_arg($data, $url);

    $response = Requests::get($url);

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        echo "Что-то пошло не так: $error_message";
        return false;
    } else {
        $body = json_decode($response->body, true);
        if ($body['errorCode']) {
            echo $body['errorMessage'];
            return false;
        }
    }

    print_file('/getcourse/log/order_status.txt', $response->body);

    return $body ?? false;

}

function check_hash_sberbank($args)
{

    $checksum = $args['checksum'];
    unset($args['checksum']);

    ksort($args);

    $data = '';
    foreach ($args as $key => $arg) {
        $data .= $key . ';' . $arg . ';';
    }

    $hash = hash_hmac('sha256', $data, get_field('sber_encryption_key', 'options'));

    return $checksum == strtoupper($hash);

}

function send_sberbank()
{

    $data = wp_unslash($_GET['data']);
    $data = json_decode($data, true);

    if (!$data) return false;

    $form_url = 'https://securepayments.sberbank.ru/payment/rest/register.do';

    $args = array(
        'token' => urlencode(get_field('sber_token', 'options')),
        'returnUrl' => urlencode(get_home_url() . '/complete'),
        'amount' => urlencode($data['amount']),
        'orderNumber' => urlencode($data['orderNumber'])
    );

    if ($data['jsonParams']) {
        $args['jsonParams'] = urlencode(json_encode($data['jsonParams']));
    }

    $form_url = add_query_arg($args, $form_url);

    $response = Requests::get($form_url, array());

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        echo "Что-то пошло не так: $error_message";
        return false;
    } else {
        $body = json_decode($response->body, true);
        if ($body['errorCode']) {
            echo $body['errorMessage'];
            return false;
        }
        $url = $body['formUrl'];
    }

    return $url ?? false;

}

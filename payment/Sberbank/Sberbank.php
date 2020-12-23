<?php

/*
 * Кабинет тестовый https://3dsec.sberbank.ru/mportal3
 * Вход T4632247232-operator/T4632247232
 * токен 55psnbbg3thon7g2jgd433vok4
 * ключ atmiumq7192mp5bob3p8u0189o
 * API T4632247232-api/T4632247232
 * Тестовые карты https://securepayments.sberbank.ru/wiki/doku.php/test_cards
 *
 * Кабинет боевой https://securepayments.sberbank.ru/mportal3
 * Вход P4632247232-operator/*
 * API P4632247232-api/N2rfSA)GXM7q*vY
 */

require_once('api/Fivecms.php');

class Sberbank extends Fivecms
{
    const TEST_SERVER = 'https://3dsec.sberbank.ru/payment/rest/';
    const TEST_FORM = 'https://3dsec.sberbank.ru/payment/merchants/sbersafe_id/payment_ru.html';
    const PROD_SERVER = 'https://securepayments.sberbank.ru/payment/rest/';

    // Суффикс для подстановки в системе банка ордера
    const SUFFIX_ORDER = '_ref_';

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
            $status = $this->get_order_status_extended($last_order->order_sber);

            if (!$status) {
                $form_url = $this->register_order();
            } elseif (isset($status->orderStatus) && $status->orderStatus == 0) {
                // Ордер ожидает оплаты
                $form_url['url'] = self::TEST_FORM . '?mdOrder=' . htmlentities($last_order->order_sber);
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
     * @param $order_sber
     * @return false|stdClass
     */
    public function get_order_status_extended($order_sber)
    {
        $data = [
            'token' => $this->payment_settings['token_sber'],
            'orderId' => $order_sber,
        ];

        $url = $this->payment_settings['test_server'] ? self::TEST_SERVER : self::PROD_SERVER;
        $url .= 'getOrderStatusExtended.do';

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

        $data = [
            'token' => $this->payment_settings['token_sber'],
            'orderNumber' => $this->order->id . self::SUFFIX_ORDER . $index,
            'amount' => (int)($price * 100),
            'returnUrl' => "{$this->config->root_url}/order?orderId={$this->order->id}&after_payment=1",
            'failUrl' => "{$this->config->root_url}/order?orderId={$this->order->id}&bad_payment=1",
            'description' => "Оплата заказа №{$this->order->id}",
            'jsonParams' => json_encode($user_data),
            'phone' => $this->order->phone
        ];

        $url = $this->payment_settings['test_server'] ? self::TEST_SERVER : self::PROD_SERVER;
        $url .= $this->payment_settings['payment_method'] . '.do';

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
            return '<iframe src="data:text/html;base64,' . $html . '" width="100%"></iframe>';
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

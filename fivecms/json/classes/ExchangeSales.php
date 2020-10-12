<?php

/*
 * Импорт и экспорт заказов
 */


class ExchangeSales extends Exchange
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    protected $mods = [
        'import',
        'export'
    ];

    protected function import()
    {
        $filename = $this->check_import_file();

        require_once JSON_READER . 'autoload.php';
        $reader = new pcrov\JsonReader\JsonReader();

        $reader->open($this->temp_dir . $filename);

        // Обновлени пользователей
        if ($reader->read('orders')) {

            $depth = $reader->depth();
            $reader->read();

            do {
                $this->import_order($reader->value());
            } while ($reader->next() && $reader->depth() > $depth);
        }

        $reader->close();

        //$this->settings->last_1c_orders_export_date = date("Y-m-d H:i:s");

        Exchange::response();
    }

    protected function import_order($json_order)
    {
        $order_id = (int)$json_order['Номер'];

        $this->db->query("SELECT id, name, phone, email FROM __users WHERE external_id=? LIMIT 1", $json_order['user_id']);
        $user = $this->db->result();

        if (!$user) {
            Exchange::add_warning("Order id {$order_id} has not been added. User is not found");
            return;
        }

        $order = [
            'date' => $json_order['Дата'] . ' ' . $json_order['Время'],
            'user_id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email
        ];

        switch ($json_order['Статус']) {
            case 'Не проведен':
                $order['status'] = 0;
                break;
            case 'Проведен':
                $order['status'] = 1;
                break;
            case 'Удален':
                $order['status'] = 3;
                break;
            case 'Оплачен':
                $order['paid'] = 1;
                break;
        }

        $existed_order = $this->orders->get_order($order_id);

        if ($existed_order) {
            $this->orders->update_order($order->id, $order);
        } else {
            $order_id = $this->orders->add_order($order);
        }

        // Товары
        $purchases_ids = [];
        foreach ($json_order['Товары'] as $json_product) {
            // Ищем товар
            $this->db->query('SELECT id FROM __products WHERE external_id=?', $json_product['product_id']);
            $product_id = $this->db->result('id');
            $this->db->query('SELECT id FROM __variants WHERE external_id=? AND product_id=?', $json_product['variant_id'], $product_id);
            $variant_id = $this->db->result('id');

            $purchase = [
                'order_id' => $order_id,
                'product_id' => $product_id,
                'variant_id' => $variant_id,
                'sku' => $json_product['Артикул'],
                'product_name' => $json_product['Наименование'],
                'amount' => $json_product['Количество'],
                'price' => $json_product['Цена'] * (100 - $json_product['Скидка']) / 100
            ];

            $this->db->query('SELECT id FROM __purchases WHERE order_id=? AND product_id=? AND variant_id=?', $order->id, $product_id, $variant_id);
            $purchase_id = $this->db->result('id');

            if ($purchase_id) {
                $purchase_id = $this->orders->update_purchase($purchase_id, $purchase);
            } else {
                $purchase_id = $this->orders->add_purchase($purchase);
            }

            $purchases_ids[] = $purchase_id;
        }

        // Удалим покупки, которых нет в файле
        foreach ($this->orders->get_purchases(['order_id' => $order_id]) as $purchase) {
            if (!in_array($purchase->id, $purchases_ids)) {
                $this->orders->delete_purchase($purchase->id);
            }
        }

        $this->db->query('UPDATE __orders SET discount=0, total_price=? WHERE id=? LIMIT 1', $json_order['Сумма'], $order_id);
    }

    protected function export()
    {
        $date_begin = $this->request->get('date_begin', 'string');
        $date_end = $this->request->get('date_end', 'string');
        $status = $this->request->get('status');

        $filter = [];

        if ($date_begin && ($date_time = strtotime($date_begin)) !== false) {
            $filter['date_from'] = date(self::DATE_FORMAT, $date_time);
        }
        if ($date_end && ($date_time = strtotime($date_end)) !== false) {
            $filter['date_to'] = date(self::DATE_FORMAT, $date_time);
        }
        if (!is_null($status)) {
            // status = Новый / Принят / Доставлен / Отменен
            $filter['status'] = (int)$status;
        }

        // По умолчанию только новые
        if (!count($filter)) {
            $filter['modified_since'] = $this->settings->last_1c_orders_export_date;
        }

        $filter['limit'] = $this->orders->count_orders($filter);

        $orders = $this->orders->get_orders($filter);
        $data = [];

        foreach ($orders as $order) {

            if ($order->user_id) {
                $this->db->query("SELECT external_id FROM __users WHERE id=? LIMIT 1", $order->user_id);
                $user_id = $this->db->result('external_id');
                if (!$user_id) {
                    Exchange::add_warning("User with id {$order->user_id} not found");
                    continue;
                }
            }

            // Товары
            $purchases = $this->orders->get_purchases(['order_id' => (int)$order->id]);

            $products = [];
            foreach ($purchases as $purchase) {

                $name = "$purchase->product_name $purchase->variant_name";
                $price = $purchase->price;
                $discount = $order->discount;
                $amount = $purchase->amount;

                $product = [
                    'Наименование' => htmlspecialchars(trim($name)),
                    'ЦенаЗаЕдиницу' => $price * (100 - $discount) / 100,
                    'Количество' => $amount,
                    'Сумма' => $amount * $price * (100 - $discount) / 100
                ];

                if ($this->settings->oneskid == 1) {
                    $product['Скидка'] = $amount * $price * (100 - $discount) / 100;
                }

                $product_id = $purchase->product_id;
                $variant_id = $purchase->variant_id;
                if ($product_id && $variant_id) {
                    $this->db->query('SELECT external_id FROM __products WHERE id=?', $product_id);
                    $product['product_id'] = $this->db->result('external_id');
                    $this->db->query('SELECT external_id FROM __variants WHERE id=?', $variant_id);
                    $product['variant_id'] = $this->db->result('external_id');
                } else {
                    if (!$product_id) {
                        Exchange::add_warning("Product {$purchase->product_name} not found");
                    } elseif (!$variant_id) {
                        Exchange::add_warning("Variant {$purchase->variant_name} not found");
                    }
                }

                $products[] = $product;
            }

            // Доставка
            $delivery = $this->delivery->get_delivery($order->delivery_id);

            // Способ оплаты
            $payment_method = $this->payment->get_payment_method($order->payment_method_id);

            $date = new DateTime($order->date);

            $item = [
                'Ид' => $order->id,
                'Номер' => $order->id,
                'Дата' => $date->format('Y-m-d'),
                'Сумма' => $order->total_price,
                'Время' => $date->format('H:i:s'),
                'Комментарий' => htmlspecialchars($order->comment),
                'user_id' => $user_id ?? '',
                'Адрес' => htmlspecialchars($order->address),
                'Товары' => $products,
                'Доставка' => [
                    'Сумма' => $order->delivery_price,
                    'Тип' => $delivery ? htmlspecialchars($delivery->name) : ''
                ],
                'Оплата' => [
                    'Метод' => $payment_method ? htmlspecialchars($payment_method->name) : '',
                    'Оплачено' => $order->paid ? 'true' : 'false'
                ]
            ];

            if ($delivery && $delivery->id == 2) {
                $this->db->query('SELECT s.external_id FROM __orders as o LEFT JOIN __shops as s ON o.shop_id = s.id  WHERE o.id=?', $order->id);
                if ($shop_id = $this->db->result('external_id')) {
                    $item['Доставка']['shop_id'] = $shop_id;
                }
            }

            // Статус
            switch ($order->status) {
                case 0:
                    $item['Статус'] = 'Новый';
                    break;
                case 1:
                    $item['Статус'] = '[N] Принят';
                    break;
                case 2:
                    $item['Статус'] = '[F] Доставлен';
                    break;
                case 3:
                    $item['Статус'] = 'Отменен';
                    break;
            }

            $data[] = $item;

        }

        $this->settings->last_1c_orders_export_date = date(self::DATE_FORMAT);

        Exchange::response(['orders' => $data]);
    }
}

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

        // Обновление ордеров
        try {
            $reader->open($this->temp_dir . $filename);

            if ($reader->read('orders')) {

                $depth = $reader->depth();
                $reader->read();

                do {
                    $this->import_order($reader->value());
                } while ($reader->next() && $reader->depth() > $depth);
            }
        } catch (Exception $exception) {
            Exchange::error_read_file($filename, $exception);
        }

        $reader->close();

        $this->settings->last_1c_orders_export_date = date(self::DATE_FORMAT);

        Exchange::response();
    }

    protected function import_order($json_order)
    {
        $order_id = $json_order['id'] ?? null;

        $this->db->query("SELECT id FROM __users WHERE external_id=? LIMIT 1", $json_order['user_id']);
        $user = $this->db->result();

        if (!$user) {
            Exchange::add_warning("Ордер {$order_id} - пользователь не найден.");
            return;
        }

        $order = new stdClass;
        $order->user_id = $user->id;

        if (!empty($json_order['name'])) {
            $order->name = $json_order['name'];
        }

        if (!empty($json_order['phone'])) {
            $order->phone = $json_order['phone'];
        }

        if (!empty($json_order['email'])) {
            $order->email = $json_order['email'];
        }

        if (!empty($json_order['address'])) {
            $order->address = $json_order['address'];
        }

        if (!empty($json_order['date'])) {
            $order->date = $json_order['date'];
        }

        if (isset($json_order['status'])) {
            $order->status = (int)$json_order['status'];
        }

        if (isset($json_order['total_price'])) {
            $order->status = (float)$json_order['total_price'];
        }

        if ($order_id && $existed_order = $this->orders->get_order((int)$order_id)) {
            $this->orders->update_order($order_id, $order);
        } else {
            $order_id = $this->orders->add_order($order);
        }

        if (empty($json_order['products'])) return;

        // Товары
        $purchases_ids = [];
        foreach ($json_order['products'] as $json_product) {
            // Ищем товар
            $j_product_id = $json_product['product_id'] ?? '';
            $this->db->query('SELECT id, name FROM __products WHERE external_id=? LIMIT 1', $j_product_id);
            $product = $this->db->result();

            if (!$product) {
                Exchange::add_warning("Ордер {$order_id} - не найден товар $j_product_id.");
                continue;
            }

            $j_variant_id = $json_product['variant_id'] ?? '';
            $this->db->query('SELECT id, sku FROM __variants WHERE external_id=? AND product_id=? LIMIT 1', $j_variant_id, $product->id);
            $variant = $this->db->result();

            if (!$variant) {
                Exchange::add_warning("Ордер {$order_id} - не найден товар $j_variant_id.");
                continue;
            }

            $purchase = [
                'order_id' => $order_id,
                'product_id' => $product->id,
                'variant_id' => $variant->id,
                'sku' => $json_product['vendor_code'] ?? $variant->sku,
                'product_name' => $json_product['name'] ?? $product->name
            ];

            if (!empty($json_product['amount'])) {
                $purchase['amount'] = $json_product['amount'];
            }

            if (!empty($json_product['price'])) {
                $purchase['price'] = $json_product['price'];
            }

            $this->db->query('SELECT id FROM __purchases WHERE order_id=? AND product_id=? AND variant_id=?', $order->id, $product->id, $variant->id);
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
                if ($purchase->product_id) {
                    $this->db->query("SELECT external_id FROM __products WHERE id=? LIMIT 1", $purchase->product_id);
                    $product_id = $this->db->result('external_id') ?: '';
                }

                if ($purchase->variant_id) {
                    $this->db->query("SELECT external_id FROM __variants WHERE id=? LIMIT 1", $purchase->variant_id);
                    $variant_id = $this->db->result('external_id') ?: '';
                }

                $products[] = [
                    'product_id' => $product_id ?? '',
                    'variant_id' => $variant_id ?? '',
                    'vendor_code' => $purchase->sku,
                    'product_name' => htmlspecialchars(trim($purchase->product_name)),
                    'amount' => $purchase->amount,
                    'price' => $purchase->price
                ];
            }

            // Доставка
            $delivery = $this->delivery->get_delivery($order->delivery_id);

            // Способ оплаты
            $payment_method = $this->payment->get_payment_method($order->payment_method_id);

            $date = new DateTime($order->date);

            $item = [
                'id' => $order->id,
                'date' => $date->format(self::DATE_FORMAT),
                'status' => $order->status,
                'total_price' => $order->total_price,
                'comment' => htmlspecialchars($order->comment),
                'products' => $products,
                'user' => [
                    'id' => $user_id ?? '',
                    'name' => $order->name,
                    'phone' => $order->phone,
                    'address' => htmlspecialchars($order->address),
                ],
                'delivery' => [
                    'id' => $order->delivery_id,
                    'type' => $delivery ? htmlspecialchars($delivery->name) : '',
                    'price' => (float)$order->delivery_price
                ],
                'payment' => [
                    'id' => $order->payment_method_id,
                    'name' => $payment_method ? htmlspecialchars($payment_method->name) : '',
                    'paid' => $order->paid,
                    'date' => $order->payment_date
                ]
            ];

            if ($delivery && $delivery->id == 2) {
                $this->db->query('SELECT s.external_id FROM __orders as o LEFT JOIN __shops as s ON o.shop_id = s.id  WHERE o.id=?', $order->id);
                if ($shop_id = $this->db->result('external_id')) {
                    $item['delivery']['shop_id'] = $shop_id;
                }
            }

            $data[] = $item;

        }

        $this->settings->last_1c_orders_export_date = date(self::DATE_FORMAT);

        Exchange::response(['orders' => $data]);
    }
}

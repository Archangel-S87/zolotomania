<?PHP

require_once('View.php');

class OrderView extends View
{
    public function __construct()
    {
        parent::__construct();
        $this->design->smarty->registerPlugin("function", "checkout_form", array($this, 'checkout_form'));
    }

    //////////////////////////////////////////
    // Основная функция
    //////////////////////////////////////////
    function fetch()
    {
        // Скачивание файла
        if ($this->request->get('file')) {
            return $this->download();
        } elseif ($this->request->get('after_payment') && $this->request->get('orderId')) {
            return $this->after_payment();
        } elseif ($this->request->get('bad_payment') && $this->request->get('orderId')) {
            return $this->bad_payment();
        } elseif ($this->request->get('new_order')) {
            return $this->new_order();
        } else {
            return $this->fetch_order();
        }
    }

    /**
     * Помещает все товары текущего заказа в корзину
     * Удаляет текущий заказ
     */
    private function new_order()
    {
        if ($url = $this->request->get('url', 'string'))
            $order = $this->orders->get_order((string)$url);
        elseif (!empty($_SESSION['order_id']))
            $order = $this->orders->get_order(intval($_SESSION['order_id']));
        else
            return;

        if (!$order) return;

        $purchases = $this->orders->get_purchases(['order_id' => $order->id]);

        foreach ($purchases as $purchase) {
            if ($variant_id = $this->variants->get_variant_id_by_external_id($purchase->variant_external_id)) {
                $this->cart->add_item($variant_id);
            }
        }

        $this->orders->update_order($order->id, ['status' => 3]);

        // Перенаправляем на корзина
        header('Location: ' . $this->config->root_url . '/cart');
        die();
    }

    /**
     * Получает данные заказа
     * @param $purchases array
     * @return array
     */
    private function get_data_purchases($purchases)
    {
        $product_external_ids = [];
        $variant_external_id = [];
        $missing_items = [];

        foreach ($purchases as $purchase) {
            $product_external_ids[] = $purchase->product_external_id;
            $variant_external_id[] = $purchase->variant_external_id;
            $missing_items[$purchase->variant_external_id] = $purchase->variant_external_id;
        }

        $products_temp = $this->products->get_products(['external_id' => $product_external_ids, 'limit' => count($product_external_ids)]);
        $products = [];
        foreach ($products_temp as $p) {
            $products[$p->external_id] = $p;
        }

        $images = $this->products->get_images(['product_external_id' => $product_external_ids]);
        foreach ($images as $image) {
            $products[$image->product_external_id]->images[] = $image;
        }

        $variants = [];
        foreach ($this->variants->get_variants(['external_id' => $variant_external_id]) as $v) {
            $variants[$v->external_id] = $v;
            unset($missing_items[$v->external_id]);
        }

        $this->design->assign('missing_items', $missing_items);

        foreach ($variants as $variant) {
            $products[$variant->external_id]->variants[] = $variant;
        }

        $product = null;
        foreach ($products as &$product) {
            if (isset($product->variants[0]))
                $product->variant = $product->variants[0];
            if (isset($product->images[0]))
                $product->image = $product->images[0];
            $product->features = $this->features->get_product_options(['product_id' => $product->id ?? 0]);
        }

        foreach ($purchases as &$purchase) {
            if (!empty($products[$purchase->product_external_id]))
                $purchase->product = $products[$purchase->product_external_id];
            if (!empty($variants[$purchase->variant_external_id])) {
                $purchase->variant = $variants[$purchase->variant_external_id];
                $purchase->features = $this->features->get_product_options(['product_id' => $product->id ?? 0]);
            }
        }

        return $purchases;
    }

    function fetch_order()
    {
        if ($url = $this->request->get('url', 'string'))
            $order = $this->orders->get_order((string)$url);
        elseif (!empty($_SESSION['order_id']))
            $order = $this->orders->get_order(intval($_SESSION['order_id']));
        else
            return false;

        if (!$order) return false;

        $purchases = $this->orders->get_purchases(['order_id' => intval($order->id)]);
        if (!$purchases) return false;

        // TODO Включить на prod
        //if (!$this->user || $this->user->id != $order->user_id) return false;

        if ($this->request->method('post')) {
            if ($payment_method_id = $this->request->post('payment_method_id', 'integer')) {
                $this->orders->update_order($order->id, ['payment_method_id' => $payment_method_id]);
                $order = $this->orders->get_order((integer)$order->id);
            } elseif ($this->request->post('reset_payment_method')) {
                $this->orders->update_order($order->id, ['payment_method_id' => null]);
                $order = $this->orders->get_order((integer)$order->id);
            }
        }

        $purchases = $this->get_data_purchases($purchases);
        $total_weight = 0;
        $total_volume = 0;
        $subtotal = 0;
        foreach ($purchases as $purchase) {
            $total_weight += $purchase->amount * $this->features->get_product_option_weight($purchase->product_id);
            $total_volume += $purchase->amount * $this->features->get_product_option_volume($purchase->product_id);
            $subtotal += $purchase->price * $purchase->amount;
        }

        // Способ доставки
        $delivery = $this->delivery->get_delivery($order->delivery_id);
        $this->design->assign('delivery', $delivery);
        $this->design->assign('total_weight', $total_weight);
        $this->design->assign('total_volume', $total_volume);
        $this->design->assign('subtotal', $subtotal);
        $this->design->assign('order', $order);
        $this->design->assign('purchases', $purchases);

        // Способ оплаты
        if ($order->payment_method_id) {
            $payment_method = $this->payment->get_payment_method($order->payment_method_id);
            $this->design->assign('payment_method', $payment_method);
        }

        // Варианты оплаты
        $payment_methods = $this->payment->get_payment_methods([
            'delivery_id' => $order->delivery_id,
            'enabled' => 1
        ]);
        $this->design->assign('payment_methods', $payment_methods);

        // Все валюты
        $this->design->assign('all_currencies', $this->money->get_currencies());

        // Загруженные файлы
        $files = $this->files->get_files(['object_id' => $order->id, 'type' => 'order']);
        $this->design->assign('cms_files', $files);

        // Выводим заказ
        return $this->design->fetch('order.tpl');
    }

    private function bad_payment()
    {
        if ($order_id = $this->request->get('orderId', 'integer'))
            $order = $this->orders->get_order((int)$order_id);
        elseif (!empty($_SESSION['order_id']))
            $order = $this->orders->get_order(intval($_SESSION['order_id']));
        else
            return false;

        if (!$order) return false;

        $purchases = $this->orders->get_purchases(['order_id' => intval($order->id)]);
        if (!$purchases) return false;

        $purchases = $this->get_data_purchases($purchases);

        $this->design->assign('order', $order);
        $this->design->assign('purchases', $purchases);

        // Способ оплаты
        if ($order->payment_method_id) {
            $payment_method = $this->payment->get_payment_method($order->payment_method_id);
            $this->design->assign('payment_method', $payment_method);
        }

        $this->design->assign('meta_title', 'Ошибка при оплате');
        return $this->design->fetch('bad_payment.tpl');
    }

    private function download()
    {
        $file = $this->request->get('file');

        if (!$url = $this->request->get('url', 'string'))
            return false;

        $order = $this->orders->get_order((string)$url);
        if (!$order)
            return false;

        if (!$order->paid)
            return false;

        // Срок жизни ссылки на скачивание 7 дней
        //if(!$order->payment_date<=date('Y-m-d H:i:s', date('U')-7*24*60*60))
        //	return false;

        // Проверяем, есть ли такой файл в покупках
        $query = $this->db->placehold("SELECT p.id FROM __purchases p, __variants v WHERE p.variant_id=v.id AND p.order_id=? AND v.attachment=?", $order->id, $file);
        $this->db->query($query);
        if ($this->db->num_rows() == 0)
            return false;

        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=\"$file\"");
        header("Content-Length: " . filesize($this->config->root_dir . $this->config->downloads_dir . $file));
        print file_get_contents($this->config->root_dir . $this->config->downloads_dir . $file);

        exit();
    }

    public function checkout_form($params, $smarty)
    {
        $module_name = preg_replace("/[^A-Za-z0-9]+/", "", $params['module']);

        $form = '';
        if (!empty($module_name) && is_file("payment/$module_name/$module_name.php")) {
            include_once("payment/$module_name/$module_name.php");
            $module = new $module_name();
            $form = $module->checkout_form($params['order_id'], $params['button_text'] ?? null);
        }
        return $form;
    }

    private function after_payment()
    {
        if ($order_id = $this->request->get('orderId', 'integer'))
            $order = $this->orders->get_order((int)$order_id);
        elseif (!empty($_SESSION['order_id']))
            $order = $this->orders->get_order(intval($_SESSION['order_id']));
        else
            return false;

        if (!$order) return false;

        // Способ оплаты
        if ($order->payment_method_id) {
            $payment_method = $this->payment->get_payment_method($order->payment_method_id);
            $this->design->assign('payment_method', $payment_method);
        }

        $this->design->assign('meta_title', 'Спасибо за покупку!');
        return $this->design->fetch('after_payment.tpl');
    }
}

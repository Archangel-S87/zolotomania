<?PHP

require_once('View.php');

class CartView extends View
{
    /**
     * Количество начисленых бонусов за первую покупку
     * @var int
     */
    private $bonus = 300;

    /**
     * Сформированый заказ
     * @var null | object
     */
    private $order = null;

    /**
     * Корзина
     * @var null | object
     */
    private $basket = null;

    public function __construct()
    {
        parent::__construct();

        // Если передан id варианта, добавим его в корзину
        if ($variant_id = $this->request->get('variant', 'integer')) {
            $this->cart->add_item($variant_id, $this->request->get('amount', 'integer'));
            header('location: ' . $this->config->root_url . '/cart/');
        }

        // Удаление товара из корзины
        if ($delete_variant_id = intval($this->request->get('delete_variant'))) {
            $this->cart->delete_item($delete_variant_id);
            if (!isset($_POST['submit_order']) || $_POST['submit_order'] != 1)
                header('location: ' . $this->config->root_url . '/cart/');
        }

        // Если нам запостили amounts, обновляем их
        if ($amounts = $this->request->post('amounts')) {
            foreach ($amounts as $variant_id => $amount) {
                $this->cart->update_item($variant_id, $amount);
            }

            $coupon_code = trim($this->request->post('coupon_code', 'string'));
            if (empty($coupon_code)) {
                $this->cart->apply_coupon('');
                header('location: ' . $this->config->root_url . '/cart');
            } else {
                $coupon = $this->coupons->get_coupon((string)$coupon_code);

                if (empty($coupon) || !$coupon->valid) {
                    $this->cart->apply_coupon($coupon_code);
                    $this->design->assign('coupon_error', 'invalid');
                } else {
                    $this->cart->apply_coupon($coupon_code);
                    header('location: ' . $this->config->root_url . '/cart');
                }
            }
        }

        if ($this->request->method('post') && $this->request->post('get_code')) {
            $this->check_phone();
        }

        if ($this->request->method('post') && $this->request->post('check_sms_code')) {
            $this->check_sms_code();
        }

        if ($this->request->post('check_buy')) {
            // Если нажали на кнопку оплатить
            $this->receipt_order();
            $this->check_buy();
        }

        if ($this->request->post('check_order')) {
            // Если нажали на кнопку заказать
            $this->receipt_order();
            $this->check_order();
        }

        // Если нажали оформить заказ
        if (isset($_POST['checkout'])) {

            $is_shop = $this->group && $this->group->name == 'Магазины';

            $order = new stdClass;
            $order->delivery_id = $is_shop ? 777 : $this->request->post('delivery_id', 'integer');
            $order->shop_id = $this->request->post('shop_id', 'integer');
            $order->payment_method_id = $is_shop ? 0 : $this->request->post('payment_method_id', 'integer');
            $order->name = $is_shop ? $this->user->name : $this->request->post('name');
            $bonus = $this->request->post('bonus', 'integer');
            $order->email = $is_shop ? $this->user->email : $this->request->post('email');
            $order->address = $is_shop ? $this->user->address : $this->request->post('address');
            $phone = $this->request->post('phone');
            $order->phone = $is_shop ? $this->user->phone : str_replace(['(', ')', ' ', '-'], '', $phone);
            $order->comment = $this->request->post('comment');
            $order->ip = $_SERVER['REMOTE_ADDR'];

            if ($this->request->post('calc')) $order->calc = $this->request->post('calc');
            if ($this->request->post('cdek')) $cdek = $this->request->post('cdek', 'float');
            if ($this->request->post('boxberry')) $boxberry = $this->request->post('boxberry', 'float');
            if ($this->request->post('shiptor')) $shiptor = $this->request->post('shiptor', 'float');

            $this->design->assign('delivery_id', $order->delivery_id);
            $this->design->assign('shop_id', $order->shop_id);
            $this->design->assign('name', $order->name);
            $this->design->assign('bonus', $bonus);
            $this->design->assign('email', $order->email);
            $this->design->assign('phone', $order->phone);
            $this->design->assign('address', $order->address);
            // Antibot
            if ($this->request->post('bttrue')) {
                $bttrue = $this->request->post('bttrue');
                $this->design->assign('bttrue', $bttrue);
            }
            if ($this->request->post('btfalse')) {
                $btfalse = $this->request->post('btfalse');
                $this->design->assign('btfalse', $btfalse);
            }
            // Antibot @

            $cart = $this->cart->get_cart();

            // Скидка | Discount
            if (!empty($cart->discount2))
                $order->discount2 = $cart->discount2;
            if (!empty($cart->value_discountgroup))
                $order->discount_group = $cart->value_discountgroup;
            if (!empty($cart->full_discount))
                $order->discount = $cart->full_discount;

            unset($cart->value_discountgroup);
            unset($cart->full_discount);

            // Пишем реферера
            if (!empty($_SESSION['referer']))
                $order->referer = $_SESSION['referer'];
            // Пишем UTM
            if (!empty($_SESSION['utm']))
                $order->utm = $_SESSION['utm'];
            // Пишем yclid
            if (!empty($_COOKIE['yclid']))
                $order->yclid = $_COOKIE['yclid'];

            // Источник заказа (в десктопе)
            $order->source = 1;

            if ($this->design->is_mobile_browser()) {
                // Источник заказа (в мобильном дизайне)
                $order->source = 2;
            }

            // Отслеживаем заказы из моб.приложения
            if ($this->design->is_android_browser()) {
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                if (preg_match('/iPad|iPhone/i', $user_agent)) {
                    // Источник заказа (в мобильном приложении iOS)
                    $order->source = 3;
                } elseif (preg_match('/Android/i', $user_agent)) {
                    // Источник заказа (в мобильном приложении Android)
                    $order->source = 4;
                }
            }

            if ($cart->coupon) {
                $order->coupon_discount = $cart->coupon_discount;
                $order->coupon_code = $cart->coupon->code;
            }

            if (!empty($this->user->id))
                $order->user_id = $this->user->id;

            if (empty($order->name)) {
                $this->design->assign('error', 'empty_name');
            } elseif (empty($bttrue)) {
                $this->design->assign('error', 'captcha');
            } elseif (!empty($btfalse)) {
                $this->design->assign('error', 'captcha');
            } elseif ($order->delivery_id == 123 && !$order->address) {
                $this->design->assign('error', 'empty_address');
            } elseif ($cart->total_price < $this->settings->minorder) {
                $this->design->assign('error', 'min_order');
            } elseif ($cart->total_price == 0) {
                $this->design->assign('error_stock', 'out_of_stock_order');
            } else {
                if ($bonus && $this->settings->bonus_limit && $this->user->balance) {
                    if (($cart->total_price * $this->settings->bonus_limit / 100) > floatval($this->user->balance))
                        $order->bonus_discount = floatval($this->user->balance);
                    else
                        $order->bonus_discount = ($cart->total_price * $this->settings->bonus_limit / 100);

                    $this->user->balance = $this->user->balance - $order->bonus_discount;
                    $this->users->update_user($this->user->id, array('balance' => $this->user->balance));
                }

                // Добавляем заказ в базу
                $order_id = $this->orders->add_order($order);

                $_SESSION['order_id'] = $order_id;

                // Если использовали купон, увеличим количество его использований
                if ($cart->coupon)
                    $this->coupons->update_coupon($cart->coupon->id, array('usages' => $cart->coupon->usages + 1));

                // Добавляем товары к заказу
                $purchase_count = 0;
                foreach ($this->request->post('amounts') as $variant_id => $amount) {
                    // Проверяю не находится ли вариант в резерве
                    $variant = $this->variants->get_variant($variant_id);
                    if (!$variant || $variant->reservation) continue;
                    // Помечаю вариант как в резерве
                    $this->variants->update_variant($variant_id, ['reservation' => 1]);

                    $this->orders->add_purchase([
                        'order_id' => $order_id,
                        'variant_id' => intval($variant_id),
                        'amount' => intval($amount)
                    ]);

                    $purchase_count++;
                }

                // В заказе нет товаров очищаю корзину
                if (!$purchase_count) {
                    $this->orders->delete_order($order_id);
                    $this->cart->empty_cart();
                    header('Location: /');
                }

                $order = $this->orders->get_order($order_id);

                // Стоимость доставки
                $delivery = $this->delivery->get_delivery($order->delivery_id);

                // Delivery calc
                if ($cart->total_weight > 0) {
                    $weight = ceil($cart->total_weight);
                } else {
                    $weight = 0.5;
                }
                if ($delivery->price2 > 0) {
                    $delivery->price = $delivery->price + ($weight * $delivery->price2);
                }
                // Delivery calc end

                if ($order->delivery_id == 3) {
                    $delivery->price = $shiptor;
                } elseif ($order->delivery_id == 114) {
                    $delivery->price = $cdek;
                } elseif ($order->delivery_id == 121) {
                    $delivery->price = $boxberry;
                } elseif ($delivery->widget == 1) {
                    $delivery->price = $this->request->post('widget_' . $delivery->id, 'float');
                }

                if (!empty($delivery) && ($delivery->free_from > $order->total_price || $delivery->free_from == 0)) {
                    $this->orders->update_order($order->id, array('delivery_price' => $delivery->price, 'separate_delivery' => $delivery->separate_payment));
                }

                // for mobile app don`t delete or change!!!
                // Автоматически регистрируем нового пользователя если не залогинен
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }

                if (!$this->user && !empty($order->phone)) {
                    $this->db->query('SELECT count(*) as count FROM __users WHERE phone=?', $order->phone);
                    $user_exists = $this->db->result('count');
                    if ($user_exists) {
                        $this->db->query('SELECT * FROM __users WHERE phone=?', $order->phone);
                        $user_exists_id = $this->db->result('id');
                        $this->orders->update_order($order->id, ['user_id' => $user_exists_id]);
                    } else {
                        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
                        $max = 10;
                        $size = StrLen($chars) - 1;
                        $password = null;
                        while ($max--) $password .= $chars[rand(0, $size)];
                        $user_id = $this->users->add_user(['password' => $password, 'name' => $order->name, 'phone' => $order->phone, 'enabled' => '1', 'last_ip' => $ip, 'external_id' => $order->phone]);
                        $this->orders->update_order($order->id, ['user_id' => $user_id]);
                        $this->notify->send_sms_message($order->phone, "Ваш пароль $password");
                        //$this->notify->email_user_registration($user_id, $password);
                        $_SESSION['user_id'] = $user_id;
                    }
                }
                // for mobile app end don`t delete or change!!!

                // add partner_id to user
                if (isset($_COOKIE['partner_id'])) {
                    if (!empty($this->user->id))
                        $user_id = $this->user->id;

                    if (!empty($user_id) && intval($user_id) != intval($_COOKIE['partner_id']) && empty($this->user->partner_id)) {
                        $partner = $this->users->get_user(intval($_COOKIE['partner_id']));
                        if (!empty($partner) && $partner->enabled)
                            $this->users->update_user(intval($user_id), array('partner_id' => $partner->id));
                    }
                } /*elseif(empty($this->user->partner_id)) {
				// не даем делать рефералами уже имеющихся клиентов
				// пользователь с id=1 должен быть системным
				if(!empty($this->user->id)) 
					$user_id = $this->user->id;
				if(!empty($user_id))
					$this->users->update_user(intval($user_id), array('partner_id'=>'1'));
			}*/

                if ($this->settings->auto_subscribe == 1 && !empty($order->email))
                    $this->mailer->add_mail($order->name, $order->email);

                // Отправляем письмо пользователю
                if (!empty($order->email))
                    $this->notify->email_order_user($order->id);

                // Отправляем письмо администратору
                $this->notify->email_order_admin($order->id);

                // функция прикрепления файлов
                if ($this->settings->attachment == 1) {
                    $files = array();
                    $files = (array)$this->request->post('files');
                    // Удаление файлов
                    /*$current_files = $this->files->get_files(array('object_id'=>$order->id,'type'=>'order'));
                    foreach($current_files as $file)
                        if(!in_array($file->id, $files['id']))
                                $this->files->delete_file($file->id);*/
                    // Порядок файлов
                    /*if($files = $this->request->post('files')){
                        $i=0;
                        foreach($files['id'] as $k=>$id)
                        {
                            $this->files->update_file($id, array('name'=>$files['name'][$k],'position'=>$i));
                            $i++;
                        }
                    }*/
                    // Загрузка файлов
                    $upload_max_filesize = $this->settings->maxattachment * 1024 * 1024;
                    if ($files = $this->request->files('files')) {
                        for ($i = 0; $i < count($files['name']); $i++) {
                            if ($files['name']['size'] < $upload_max_filesize) {
                                if ($file_name = $this->files->upload_file($files['tmp_name'][$i], $files['name'][$i])) {
                                    $this->files->add_file($order->id, 'order', $file_name);
                                } else {
                                    $this->design->assign('error', 'error uploading file');
                                }
                            }
                        }
                    }
                    $files = $this->files->get_files(array('object_id' => $order->id, 'type' => 'order'));
                }
                // функция прикрепления файлов end

                // Очищаю избранное от заказаных товаров
                if (!empty($_COOKIE['wished_products'])) {
                    $products_ids = explode(',', $_COOKIE['wished_products']);
                    foreach ($cart->purchases as $purchase) {
                        $key = array_search($purchase->product->id, $products_ids);
                        if ($key !== false) unset($products_ids[$key]);
                    }
                    if (!count($products_ids)) {
                        unset($_COOKIE['wished_products']);
                        setcookie('wished_products', '', time() - 365 * 24 * 3600, '/');
                    } else {
                        setcookie('wished_products', implode(',', $products_ids), time() + 365 * 24 * 3600, '/');
                    }
                }

                // Очищаем корзину (сессию)
                //$this->cart->empty_cart();

                // Перенаправляем на страницу заказа
                //header('Location: ' . $this->config->root_url . '/order/' . $order->url);
            }
        }

    }

    /**
     * Заполнение заказа
     */
    private function receipt_order()
    {
        $order = new stdClass;
        $order->name = $this->request->post('name');
        $order->address = '';
        $order->phone = $this->user->phone;
        $order->comment = $this->request->post('comment');
        $order->ip = $_SERVER['REMOTE_ADDR'];

        $_SESSION['cart'] = [
            'name' => $order->name,
            'comment' => $order->comment,
        ];

        // Antibot
        if ($this->request->post('bttrue')) {
            $bttrue = $this->request->post('bttrue');
            $_SESSION['cart']['bttrue'] = $bttrue;
        }
        if ($this->request->post('btfalse')) {
            $btfalse = $this->request->post('btfalse');
            $_SESSION['cart']['btfalse'] = $btfalse;
        }
        // Antibot @

        $cart = $this->cart->get_cart();

        // Скидка | Discount
        if (!empty($cart->discount2))
            $order->discount2 = $cart->discount2;
        if (!empty($cart->value_discountgroup))
            $order->discount_group = $cart->value_discountgroup;
        if (!empty($cart->full_discount))
            $order->discount = $cart->full_discount;

        unset($cart->value_discountgroup);
        unset($cart->full_discount);

        // Пишем реферера
        if (!empty($_SESSION['referer']))
            $order->referer = $_SESSION['referer'];
        // Пишем UTM
        if (!empty($_SESSION['utm']))
            $order->utm = $_SESSION['utm'];
        // Пишем yclid
        if (!empty($_COOKIE['yclid']))
            $order->yclid = $_COOKIE['yclid'];

        // Источник заказа (в десктопе)
        $order->source = 1;

        if ($this->design->is_mobile_browser()) {
            // Источник заказа (в мобильном дизайне)
            $order->source = 2;
        }

        if ($cart->coupon) {
            $order->coupon_discount = $cart->coupon_discount;
            $order->coupon_code = $cart->coupon->code;
        }

        $order->user_id = $this->user->id;

        $deliveries = $this->delivery->get_deliveries(['enabled' => 1]);

        // Способ покупки
        $purchase_method = $this->request->post('purchase_method', 'string');
        if ($purchase_method) {
            $_SESSION['cart']['purchase_method'] = $purchase_method;
        }

        if ($purchase_method == 'bring_me') {
            // Приветси на дом
            foreach ($deliveries as $delivery) {
                if ($delivery->name == 'Домой') {
                    $order->delivery_id = $delivery->id;
                    break;
                }
            }

            // Проверка адреса
            $error_address = false;
            $data_address = $this->request->post('user_data');
            foreach ($data_address as $input => $value) {
                if (!$value) {
                    $error_address = true;
                }
                $_SESSION['cart']['users_address_list'][$input] = $value;
            }
            if (!$error_address) {
                $order->address = implode(', ', $data_address);
            }


        } else {
            // Приветси в магазин
            foreach ($deliveries as $delivery) {
                if ($delivery->name == 'В магазин') {
                    $order->delivery_id = $delivery->id;
                    break;
                }
            }

            // Получение адреса магазина
            $shop_id = $this->request->post('shop_id', 'integer');

            $shop_group_id = 0;
            foreach ($this->users->get_groups() as $group) {
                if ($group->name != 'Магазины') continue;
                $shop_group_id = $group->id;
                break;
            }

            $this->db->query('SELECT external_id FROM __users WHERE id=? AND group_id=? LIMIT 1', (int)$shop_id, (int)$shop_group_id);
            $shop_external_id = $this->db->result('external_id');
            if (!$shop_external_id) {
                $_SESSION['cart']['error'] = 'empty_shop_id';
                return;
            }

            $order->shop_external_id = $shop_external_id;

            $shop_data = $this->users->get_user_data($shop_id);
            $shop_address = [
                $shop_data->region,
                $shop_data->district,
                $shop_data->city,
                $shop_data->street,
                $shop_data->house
            ];
            $order->address = implode(', ', $shop_address);
        }

        // Бонус
        $_SESSION['cart']['bonus'] = (int)$this->request->post('bonus');

        $this->basket = $cart;
        $this->order = $order;

        if (empty($order->name)) {
            $_SESSION['cart']['error'] = 'empty_name';
        } elseif (empty($bttrue)) {
            $_SESSION['cart']['error'] = 'captcha';
        } elseif (!empty($btfalse)) {
            $_SESSION['cart']['error'] = 'captcha';
        } elseif (!$order->address) {
            $_SESSION['cart']['error'] = 'empty_address';
        } elseif ($cart->total_price < $this->settings->minorder) {
            $_SESSION['cart']['error'] = 'min_order';
        } elseif ($cart->total_price == 0) {
            $_SESSION['cart']['error_stock'] = 'out_of_stock_order';
        } else {
            unset($_SESSION['cart']['error']);
            unset($_SESSION['cart']['error_stock']);

            // Если новый юзер
            $orders = $this->orders->get_orders(['user_id' => $this->user->id]);
            $new_user = $this->check_user_is_new($this->user->id, $orders);

            if ($new_user) {
                $this->user->balance = $this->bonus;
            }
        }
    }

    /**
     * Кнопка заказать
     */
    private function check_order()
    {
        if (isset($_SESSION['cart']['error']) || isset($_SESSION['cart']['error_stock'])) return;

        unset($_POST['bonus']);

        $this->save_order();

        unset($_SESSION['cart']);

        // Перенаправляем на страницу заказа
        header('Location: ' . $this->config->root_url . '/order?after_payment=1&orderId=' . $this->order->id);
    }

    /**
     * Онлаин оплата
     */
    private function check_buy()
    {
        if (isset($_SESSION['cart']['error']) || isset($_SESSION['cart']['error_stock'])) return;

        $payment_methods = $this->payment->get_payment_methods(['enabled' => 1]);
        foreach ($payment_methods as $payment_method) {
            if ($payment_method->module == 'Sberbank') {
                $this->order->payment_method_id = $payment_method->id;
                break;
            }
        }
        $this->save_order();

        // формирование ссылки для оплаты
        $payment = $this->payment->get_payment_module('Sberbank');
        if (!($payment instanceof Sberbank)) return;
        $form_url = $payment->checkout_form($this->order->id, null, false);

        unset($_SESSION['cart']['error_sber']);

        if (!is_array($form_url)) {
            $_SESSION['cart']['error_sber'] = $form_url;
        } elseif (isset($form_url['url'])) {
            unset($_SESSION['cart']);
            header('Location: ' . $form_url['url']);
        } else {
            $html = '';
            if (isset($form_url['error'])) {
                $html .= "<p>{$form_url['error']}</p>";
            }
            $html .= '<p>При оплате возникла ошибка</p>';
            $_SESSION['cart']['error_sber'] = $html;
        }
    }

    /**
     * Сохранение заказа
     */
    private function save_order()
    {
        $bonus = $_SESSION['cart']['bonus'];

        if ($bonus && $this->settings->bonus_limit && $this->user->balance) {
            $bonus = abs((float)$bonus);
            $_SESSION['cart']['bonus'] = (int)$bonus;
            $this->user->balance = (float)$this->user->balance;

            $bonus = $bonus > $this->user->balance ? $this->user->balance : $bonus;
            $bonus_limit = $this->basket->total_price * $this->settings->bonus_limit / 100;

            $this->order->bonus_discount = $bonus_limit > $bonus ? $bonus : $bonus_limit;

            $this->user->balance = $this->user->balance - $this->order->bonus_discount;
            $this->users->update_user($this->user->id, ['balance' => $this->user->balance]);
        }

        // Добавляем заказ в базу
        $order_id = $this->orders->add_order($this->order);

        $_SESSION['order_id'] = $order_id;

        // Если использовали купон, увеличим количество его использований
        if ($this->basket->coupon) {
            $this->coupons->update_coupon($this->basket->coupon->id, ['usages' => $this->basket->coupon->usages + 1]);
        }

        // Добавляем товары к заказу
        $purchase_count = 0;
        foreach ($this->request->post('amounts') as $variant_id => $amount) {
            // Проверяю не находится ли вариант в резерве
            $variant = $this->variants->get_variant($variant_id);
            if (!$variant || $variant->reservation) continue;

            // Помечаю вариант как в резерве
            $this->variants->update_variant($variant_id, ['reservation' => 1]);

            $purchase = [
                'order_id' => $order_id,
                'variant_id' => intval($variant_id),
                'amount' => intval($amount)
            ];
            $this->orders->add_purchase($purchase);

            $purchase_count++;
        }

        // В заказе нет товаров очищаю корзину
        if (!$purchase_count) {
            $this->orders->delete_order($order_id);
            $this->cart->empty_cart();
            header('Location: /');
        }

        $this->order = $this->orders->get_order($order_id);

        // add partner_id to user
        if (isset($_COOKIE['partner_id'])) {
            $user_id = (int)$this->user->id;
            if ($user_id != (int)$_COOKIE['partner_id'] && empty($this->user->partner_id)) {
                $partner = $this->users->get_user((int)$_COOKIE['partner_id']);
                if (!empty($partner) && $partner->enabled) {
                    $this->users->update_user($user_id, ['partner_id' => $partner->id]);
                }
            }
        } /*elseif(empty($this->user->partner_id)) {
				// не даем делать рефералами уже имеющихся клиентов
				// пользователь с id=1 должен быть системным
				if(!empty($this->user->id))
					$user_id = $this->user->id;
				if(!empty($user_id))
					$this->users->update_user(intval($user_id), array('partner_id'=>'1'));
			}*/

        // Очищаю избранное от заказаных товаров
        if (!empty($_COOKIE['wished_products'])) {
            $products_ids = explode(',', $_COOKIE['wished_products']);
            foreach ($this->basket->purchases as $purchase) {
                $key = array_search($purchase->product->id, $products_ids);
                if ($key !== false) unset($products_ids[$key]);
            }
            if (!count($products_ids)) {
                unset($_COOKIE['wished_products']);
                setcookie('wished_products', '', time() - 365 * 24 * 3600, '/');
            } else {
                setcookie('wished_products', implode(',', $products_ids), time() + 365 * 24 * 3600, '/');
            }
        }

        // Очищаем корзину (сессию)
        $this->cart->empty_cart();

        // У админа все ордера выставляем как удалён
        // Снимаю резерв с вариантов товара
        if ((int)$this->user->id == 1) {
            $query = $this->db->placehold("UPDATE __orders SET status=3 WHERE id=? LIMIT 1", $order_id);
            $this->db->query($query);
            foreach ($this->orders->get_purchases(['order_id' => $order_id]) as $purchase) {
                $this->variants->update_variant($purchase->variant_id, ['reservation' => 0]);
            }
        }
    }

    /**
     * Регистрирует нового юзера
     * Отправояет на указаный номер телефона cmc с кодом
     */
    private function check_phone()
    {
        if ($this->user) {
            echo json_encode(['error' => 'Вы уже авторизованы!']);
            exit();
        }

        $response = [];
        $error = false;
        $is_code = 1;

        $phone = $this->request->post('phone');
        $phone = str_replace(['(', ')', ' ', '-'], '', $phone);

        // Выбираем пользователя из базы
        $this->db->query("SELECT * FROM __users WHERE phone=? LIMIT 1", $phone);
        $user = $this->db->result();

        if (!$user) {
            // Автоматически регистрируем нового пользователя если не залогинен
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
            $max = 10;
            $size = StrLen($chars) - 1;
            $password = null;
            while ($max--) $password .= $chars[rand(0, $size)];
            $user_id = $this->users->add_user(['password' => $password, 'name' => '', 'phone' => $phone, 'enabled' => 1, 'last_ip' => $ip, 'external_id' => $phone]);

            $user = $this->users->get_user($user_id);
            if ($user) {
                $res = $this->notify->send_sms_code($user);
                if (!is_numeric($res)) {
                    $error = $res;
                    $is_code = 0;
                }
                $this->notify->send_sms_message($phone, "Ваш пароль $password");
            } else {
                $error = 'Регистрация не удалась';
                $is_code = 0;
            }
        } else {
            if (!$user->enabled) {
                $this->users->update_user((int)$user->id, ['enabled' => 1]);
            }
            // Отправка смс на номер пользователя
            if (!$this->notify->check_sms_send($phone, $user->id)) {
                $res = $this->notify->send_sms_code($user);
                if (!is_numeric($res)) {
                    $error = $res;
                    $is_code = 0;
                }
            } else {
                $error = 'Вам уже отправлено sms с кодом';
            }
        }

        $response['error'] = $error;
        $response['is_code'] = $is_code;
        echo json_encode($response);
        exit();
    }

    /**
     * Проверяет введёный код из смс
     * Авторизует юзера
     */
    private function check_sms_code()
    {
        if ($this->user) {
            echo json_encode(['error' => 'Вы уже авторизованы!']);
            exit();
        }

        $code = $this->request->post('sms_code');

        if (!$confirm = $this->notify->check_sms_code($code)) {
            echo json_encode(['error' => 'Неверный код']);
            exit();
        }

        $user = $this->users->get_user((int)$confirm->user_id);
        if (!$user) {
            echo json_encode(['error' => 'Пользователь не найден']);
            exit();
        }

        $_SESSION['user_id'] = $user->id;

        $this->notify->activate_confirm();

        if ($this->settings->cart_storage == 2) {
            $this->cart->base_to_cart($user->id);
            $this->cart->cart_to_base();
        }

        echo json_encode(['url' => $this->config->root_url . '/cart']);
        exit();
    }

    /**
     * Проверяет новый ли юзер
     * @param $user_id integer
     * @param $orders array
     * @return bool
     */
    private function check_user_is_new($user_id, $orders)
    {
        $this->db->query('SELECT external_id FROM __users WHERE id=? LIMIT 1', $this->user->id);
        $external_id = $this->db->result('external_id');
        return $this->user->phone == $external_id && !$orders;
    }

    //////////////////////////////////////////
    // Основная функция
    //////////////////////////////////////////
    function fetch()
    {
        $this->design->assign('name', $_SESSION['cart']['name'] ?? $this->user->name);
        $this->design->assign('shop_id', $_SESSION['cart']['shop_id'] ?? '');
        $this->design->assign('comment', $_SESSION['cart']['comment'] ?? '');

        // Ошибки
        if (!empty($_SESSION['cart']['error'])) {
            $this->design->assign('error', $_SESSION['cart']['error']);
        }
        if (!empty($_SESSION['cart']['error_stock'])) {
            $this->design->assign('error_stock', $_SESSION['cart']['error_stock']);
        }
        if (!empty($_SESSION['cart']['error_sber'])) {
            $this->design->assign('error_sber', $_SESSION['cart']['error_sber']);
        }
        if (!$this->design->get_var('error_stock')) {
            unset($_SESSION['cart']['error_stock']);
        }

        // Способ оплаты
        $this->design->assign('purchase_method', $_SESSION['cart']['purchase_method'] ?? '');

        // Способы доставки для магазинов и клиентов разные
        $is_shop = $this->group && $this->group->name == 'Магазины';
        $this->design->assign('is_shop', $is_shop);

        if (!$is_shop) {

            // Если существуют валидные купоны, нужно вывести инпут для купона
            if ($this->coupons->count_coupons(['valid' => 1]) > 0) {
                $this->design->assign('coupon_request', true);
            }

            // Получение адресов магазинов
            $shop_group_id = 0;
            foreach ($this->users->get_groups() as $group) {
                if ($group->name != 'Магазины') continue;
                $shop_group_id = $group->id;
                break;
            }

            $shops_address_list = [];
            foreach ($this->users->get_users(['group_id' => $shop_group_id]) as $shop) {
                $shop_data = $this->users->get_user_data($shop->id);
                $shop_address = [
                    $shop_data->region,
                    $shop_data->district,
                    $shop_data->city,
                    $shop_data->street,
                    $shop_data->house
                ];
                $shops_address_list[$shop->id] = implode(', ', $shop_address);;
            }

            $this->design->assign('shops_address_list', $shops_address_list);

            // Список магазинов
            $shops = $this->variants->get_shops();
            $this->design->assign('shops', $shops);

            // Данные пользователя
            if ($this->user) {
                // Количество бонусов
                $this->design->assign('bonus', $this->bonus);

                $user_data = $this->users->get_user_data($this->user->id);
                $this->design->assign('user_data', $user_data);

                // Поиск уникальных адресо юзера
                $orders = $this->orders->get_orders(['user_id' => $this->user->id]);

                // Проверка на новый юзер
                $new_user = $this->check_user_is_new($this->user->id, $orders);
                $this->design->assign('new_user', $new_user);
                if (!$new_user) {
                    $this->design->assign('bonus', $_SESSION['cart']['bonus'] ?? '');
                }

                // Последним адресом добавляю адрес указаный в анкете
                $user_address = [
                    $user_data->region,
                    $user_data->district,
                    $user_data->city,
                    $user_data->street,
                    $user_data->house,
                    $user_data->apartment
                ];
                // Проверка на пустой адрес
                if (implode('', $user_address)) {
                    $orders['user_address'] = new stdClass();
                    $orders['user_address']->address = implode(', ', $user_address);
                }

                $users_address_list = [];
                foreach ($orders as $item) {
                    if (!$item->address) continue;
                    $hash = md5($item->address);
                    if (!isset($users_address_list[$hash])) {
                        $users_address_list[$hash] = $item->address;
                    }
                }

                $this->design->assign('users_address_list', $users_address_list);

                if (isset($_SESSION['cart']['users_address_list'])) {
                    foreach ($_SESSION['cart']['users_address_list'] as $input => $value) {
                        $this->design->assign('user_data_' . $input, $value);
                    }
                }

                $this->design->assign('phone', $this->user->phone);
            }

        }

        // Выводим корзину
        return $this->design->fetch('cart.tpl');
    }

}

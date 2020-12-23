<?PHP

require_once('View.php');

class RegisterView extends View
{
    const DEFAULT_STATUS = 1; // Активен ли пользователь сразу после регистрации (0 или 1)

    private $template = 'register.tpl';

    function fetch()
    {
        if ($this->user) {
            header('Location: ' . $this->config->root_url . '/user');
            exit();
        }

        // auth ULogin start
        if (isset($_POST['token'])) {
            $this->auth_ULogin();
        }
        // ulogin end

        // Активация аккаунта
        if ($this->request->get('action') == 'activate') {
            $this->activate();
            $this->template = 'user_activate.tpl';
        } elseif ($this->request->method('post') && $this->request->post('register')) {
            $this->register();
        }

        return $this->design->fetch($this->template);
    }

    private function register()
    {
        $name = $this->request->post('name');
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $tel = $this->request->post('tel');
        $ip = $this->design->get_user_ip();
        // antibot
        if ($this->request->post('bttrue')) {
            $bttrue = $this->request->post('bttrue');
            $this->design->assign('bttrue', $bttrue);
        }
        if ($this->request->post('btfalse')) {
            $btfalse = $this->request->post('btfalse');
            $this->design->assign('btfalse', $btfalse);
        }
        // antibot end

        $this->design->assign('name', $name);
        $this->design->assign('email', $email);

        $phone = str_replace(['(', ')', ' ', '-'], '', $tel);
        $this->design->assign('tel', $tel);

        if ($email) {
            $this->db->query('SELECT count(*) as count FROM __users WHERE email=?', $email);
            $this->design->assign('user_exists_message', 'email');
        } elseif ($email && $phone) {
            $this->db->query('SELECT count(*) as count FROM __users WHERE email=? AND phone=?', $email, $phone);
            $this->design->assign('user_exists_message', '');
        } else {
            $this->db->query('SELECT count(*) as count FROM __users WHERE phone=?', $phone);
            $this->design->assign('user_exists_message', 'phone');
        }

        $user_exists = $this->db->result('count');

        /*if($this->settings->spam_ip == 1 && (
                (!empty($ip) && $ip == $this->settings->last_ip_reg) ||
                (!empty(session_id()) && session_id() == $this->settings->session_id)
            )){
            $this->design->assign('error', 'ip');
        }
        else*/
        if ($user_exists)
            $this->design->assign('error', 'user_exists');
        elseif (empty($name))
            $this->design->assign('error', 'empty_name');
        elseif ($this->settings->spam_cyr == 1 && !preg_match('/^[а-яё \t]+$/iu', $name))
            $this->design->assign('error', 'wrong_name');
        elseif (!empty($this->settings->spam_symbols) && mb_strlen($name, 'UTF-8') > $this->settings->spam_symbols)
            $this->design->assign('error', 'captcha');
        elseif (empty($tel))
            $this->design->assign('error', 'empty_tel');
        elseif (!preg_match('/^\+7[\d]{5,15}$/i', $phone))
            $this->design->assign('error', 'invalid_tel');
        elseif (empty($password))
            $this->design->assign('error', 'empty_password');
        elseif (empty($bttrue))
            $this->design->assign('error', 'captcha');
        elseif (!empty($btfalse))
            $this->design->assign('error', 'captcha');
        elseif ($user_id = $this->users->add_user(['name' => $name, 'email' => $email ?: '', 'password' => $password, 'phone' => $phone, 'enabled' => self::DEFAULT_STATUS, 'last_ip' => $_SERVER['REMOTE_ADDR'], 'external_id' => $phone])) {
            $this->notify->email_user_registration($user_id, $password);

            if ($this->settings->auto_subscribe == 1)
                $this->mailer->add_mail($name, $email);

            // Записываем сессию и IP для блокировки повторной регистрации
            if (!empty($ip))
                $this->settings->last_ip_reg = $ip;
            if (!empty(session_id()))
                $this->settings->session_id = session_id();

            $_SESSION['user_id'] = $user_id;

            if ($this->settings->cart_storage == 2) {
                $this->cart->base_to_cart($user_id);
                $this->cart->cart_to_base();
            }

            // add partner_id to user
            if (isset($_COOKIE['partner_id'])) {
                if (isset($user_id) && intval($user_id) != intval($_COOKIE['partner_id'])) {
                    $partner = $this->users->get_user(intval($_COOKIE['partner_id']));
                    if (!empty($partner) && $partner->enabled)
                        $this->users->update_user(intval($user_id), array('partner_id' => $partner->id));
                }
            }

            /*if(!empty($_SESSION['current_for_login']))
                header('Location: '.$_SESSION['current_for_login']);
            else*/

            header('Location: ' . $this->config->root_url . '/user/activate');
        } else
            $this->design->assign('error', 'unknown error');
    }

    private function activate()
    {
        // Если запостили телефон
        if ($this->request->method('post') && $this->request->post('phone')) {
            $phone = $this->request->post('phone');

            $phone = str_replace(['(', ')', ' ', '-'], '', $phone);
            if (!preg_match('/^\+7[\d]{5,15}$/i', $phone)) {
                $this->design->assign('error', 'invalid_phone');
                return;
            }
            // Проверка на дубль телефонов
            $this->db->query("SELECT * FROM __users WHERE phone=? AND enabled=0 LIMIT 1", $phone);
            $save_user = $this->db->result();
            if ($save_user->id != $_SESSION['user_id']) {
                $this->design->assign('error', 'user_exists');
                return;
            }
            if ($save_user->phone != $phone) {
                $this->users->update_user($_SESSION['user_id'], ['phone' => $phone]);
                $save_user = $this->users->get_user((int)$_SESSION['user_id']);
            }

            // Отправка смс на номер пользователя
            $this->design->assign('send_code', true);
            $this->design->assign('phone', $phone);

            if (!$this->notify->check_sms_send($phone, $save_user->id)) {
                $res = $this->notify->send_sms_code($save_user);
                if (!is_numeric($res)) $this->design->assign('error', $res);
            } else {
                $this->design->assign('error', 'sms_send');
            }
        } // Если пришол код
        elseif ($this->request->method('post') && $this->request->post('sms_code')) {

            $code = $this->request->post('sms_code');
            $this->design->assign('send_code', true);

            if (!$this->notify->check_sms_code($code)) {
                $this->design->assign('error', 'error_code');
                return;
            }

            if (!$user = $this->users->get_user(intval($_SESSION['user_id'] ?? 0))) {
                $this->design->assign('error', 'user_not_found');
                return;
            }

            $this->notify->activate_confirm();
            $this->users->update_user($_SESSION['user_id'], ['enabled' => 1]);

            header('Location: ' . $this->config->root_url . '/user/login');

        } else {
            $user = $this->users->get_user(intval($_SESSION['user_id'] ?? 0));
            if (!$user) {
                $this->design->assign('error', 'user_not_found');
                return;
            }

            $this->design->assign('phone', $user->phone);

        }
    }

    private function auth_ULogin()
    {
        $s = file_get_contents('https://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $fivecms = json_decode($s, true);

        if (isset($fivecms['identity'])) {
            $name = $fivecms['first_name'] . ' ' . $fivecms['last_name'];
            $email = $fivecms['email'];
            $password = md5($fivecms['identity'] . 'newpass');
            //checking in DB if e-mail exists
            $this->db->query('SELECT count(*) as count, id FROM __users WHERE email=?', $email);
            $user_exists = $this->db->result();
            if ($user_exists->count) {
                $_SESSION['user_id'] = $user_exists->id;

                if ($this->settings->cart_storage == 2) {
                    $this->cart->base_to_cart($user_exists->id);
                    $this->cart->cart_to_base();
                }

                /*if(!empty($_SESSION['current_for_login']))
                    header('Location: '.$_SESSION['current_for_login']);
                else*/
                header('Location: ' . $this->config->root_url . '/user');
            } else {
                $user_id = $this->users->add_user(
                    array('name' => $name,
                        'email' => $email,
                        'password' => $password,
                        'enabled' => 1)
                );

                $_SESSION['user_id'] = $user_id;

                if ($this->settings->cart_storage == 2) {
                    $this->cart->base_to_cart($user_id);
                    $this->cart->cart_to_base();
                }

                // add partner_id to user
                if (isset($_COOKIE['partner_id'])) {
                    if (isset($user_id) && intval($user_id) != intval($_COOKIE['partner_id'])) {
                        $partner = $this->users->get_user(intval($_COOKIE['partner_id']));
                        if (!empty($partner) && $partner->enabled)
                            $this->users->update_user(intval($user_id), array('partner_id' => $partner->id));
                    }
                }

                $this->notify->email_user_registration($user_id, $password);
                if ($this->settings->auto_subscribe == 1)
                    $this->mailer->add_mail($name, $email);

                /*if(!empty($_SESSION['current_for_login']))
                    header('Location: '.$_SESSION['current_for_login']);
                else*/
                header('Location: ' . $this->config->root_url . '/user');
            }
        }
    }
}

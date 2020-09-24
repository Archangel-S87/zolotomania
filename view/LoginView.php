<?PHP

require_once('View.php');

class LoginView extends View
{
	function fetch()
	{
		// Получаем IP-посетителя
		$ip = $this->design->get_user_ip();
	
		// Выход
		if($this->request->get('action') == 'logout')
		{
			unset($_SESSION['user_id']);
			if(!empty($_SESSION['current_for_login']))
				header('Location: '.$_SESSION['current_for_login']);				
			else
				header('Location: '.$this->config->root_url.'/user');
			exit();
		}
		// Вспомнить пароль
		elseif($this->request->get('action') == 'password_remind')
		{
			// Если запостили email
			if($this->request->method('post') && $this->request->post('email'))
			{
				$email = $this->request->post('email');
				$this->design->assign('email', $email);
				
				// Выбираем пользователя из базы
				$user = $this->users->get_user($email);
				if(!empty($user))
				{
					$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
		    		$max=10; 
		    		$size=StrLen($chars)-1; 
		    		$password=null; 
		    		while($max--) $password.=$chars[rand(0,$size)];
					$this->users->update_user($user->id, array('password'=>$password));
					
					// Отправляем письмо пользователю для восстановления пароля
					$this->notify->email_password_remind($user->id, $password);
					$this->design->assign('email_sent', true);
				}
				else
				{
					$this->design->assign('error', 'user_not_found');
				}
			}
			// Если к нам перешли по ссылке для восстановления пароля
			elseif($this->request->get('code'))
			{
				// Проверяем существование сессии
				if(!isset($_SESSION['password_remind_code']) || !isset($_SESSION['password_remind_user_id']))
				return false;
				
				// Проверяем совпадение кода в сессии и в ссылке
				if($this->request->get('code') != $_SESSION['password_remind_code'])
					return false;
				
				// Выбераем пользователя из базы
				$user = $this->users->get_user(intval($_SESSION['password_remind_user_id']));
				if(empty($user))
					return false;
				
				// Залогиниваемся под пользователем и переходим в кабинет для изменения пароля
				$_SESSION['user_id'] = $user->id;
				
				if($this->settings->cart_storage == 2) {
					$this->cart->base_to_cart($user->id);
					$this->cart->cart_to_base();
				}
				
				header('Location: '.$this->config->root_url.'/user');
			}
			return $this->design->fetch('password_remind.tpl');
		}
        // Активация аккаунта
        elseif ($this->request->get('action') == 'activate') {

            // Если запостили телефон
            if($this->request->method('post') && $this->request->post('phone'))
            {
                $phone = $this->request->post('phone');
                $this->design->assign('phone', $phone);

                $phone = str_replace(['(', ')', ' ', '-'], '', $phone);

                if (!preg_match('/^\+7[\d]{5,15}$/i', $phone)) {
                    $this->design->assign('error', 'invalid_phone');
                } else {

                    $this->db->query("SELECT id FROM __users WHERE phone=? LIMIT 1", $phone);

                    if ($user_id = $this->db->result('id')) {

                        $user = $this->users->get_user(intval($user_id));

                        if ($user->password) {
                            $this->design->assign('error', 'has_password');
                        } else {
                            // Отправка смс на номер пользователя

                            $this->design->assign('send_code', true);
                            $this->design->assign('email', $user->email);

                            $_SESSION['activate_id'] = $user_id;
                            $_SESSION['phone'] = $phone;

                            $code = $this->generate_sms_code();

                            require_once 'sms/smsc.ru.php';

                            $message = 'Код подтверждения активации ' . $code;

                            $res = send_sms($phone, $message);

                            if ($res[1] <= 0) {
                                $this->design->assign('error', 'Ошибка sms №' . -$res[1]);
                            }

                        }

                    } else {
                        $this->design->assign('error', 'user_not_found');
                    }
                }

            }
            // Если пришол код
            elseif ($this->request->method('post') && $this->request->post('sms_code'))
            {
                $code = $this->request->post('sms_code');
                $email = $this->request->post('email');
                $password = $this->request->post('password');

                $this->design->assign('email', $email);
                $this->design->assign('send_code', true);

                $user = $this->users->get_user(intval($_SESSION['activate_id']));

                $this->db->query('SELECT count(*) as count FROM __users WHERE email=? AND id!=?', $email, $user->id);
                $user_exists = $this->db->result('count');

                if($user_exists)
                    $this->design->assign('error', 'user_exists');
                elseif(empty($email))
                    $this->design->assign('error', 'empty_email');
                elseif(empty($password))
                    $this->design->assign('error', 'empty_password');
                elseif(empty($code) || $code != $this->generate_sms_code())
                    $this->design->assign('error', 'Неверный код подтверждения');
                else {
                    $this->users->update_user($user->id, [
                        'email' => $email,
                        'password' => $password
                    ]);

                    unset($_SESSION['activate_id']);
                    unset($_SESSION['phone']);

                    header('Location: ' . $this->config->root_url . '/user/login');
                }

            }

            return $this->design->fetch('user_activate.tpl');
        }
		// auth ULogin
		elseif(isset($_POST['token'])) {
			$s = file_get_contents('https://ulogin.ru/token.php?token='.$_POST['token'].'&host='.$_SERVER['HTTP_HOST']);
			$fivecms = json_decode($s, true);
			
			if (isset($fivecms['identity'])) {
				$name = $fivecms['first_name'].' '.$fivecms['last_name'];
				$email = $fivecms['email'];
				$password = md5($fivecms['identity'].'newpass');
				//checking in DB if e-mail exists
				$this->db->query('SELECT count(*) as count, id FROM __users WHERE email=?', $email);
				$user_exists = $this->db->result();
				if($user_exists->count) {
					$_SESSION['user_id'] = $user_exists->id;
					if($this->settings->cart_storage == 2) {
						$this->cart->base_to_cart($user_exists->id);
						$this->cart->cart_to_base();
					}
					/*if(!empty($_SESSION['current_for_login']))
						header('Location: '.$_SESSION['current_for_login']);				
					else*/
						header('Location: '.$this->config->root_url.'/user');
				} else {
					$user_id = $this->users->add_user(
					array('name'=>$name,
					'email'=>$email,
					'password'=>$password,
					'enabled'=>1)
					);

					$_SESSION['user_id'] = $user_id;
					
					if($this->settings->cart_storage == 2) {
						$this->cart->base_to_cart($user_id);
						$this->cart->cart_to_base();
					}
					
					// add partner_id to user
					if(isset($_COOKIE['partner_id'])){
						if(isset($user_id) && intval($user_id) != intval($_COOKIE['partner_id'])) {
							$partner = $this->users->get_user(intval($_COOKIE['partner_id']));
							if(!empty($partner) && $partner->enabled)
								$this->users->update_user(intval($user_id), array('partner_id'=>$partner->id));
						}
					}
					
					$this->notify->email_user_registration($user_id, $password);
					
					if($this->settings->auto_subscribe == 1)
						$this->mailer->add_mail($name, $email);
					
					/*if(!empty($_SESSION['current_for_login']))
						header('Location: '.$_SESSION['current_for_login']);				
					else*/
						header('Location: '.$this->config->root_url.'/user');
				}
			}
		}
		elseif($this->request->method('get') && $this->request->get('unsubscribe'))
        {
			$mail = $this->request->get('unsubscribe');
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $query = $this->db->placehold('select id from __maillist where email=?', $mail);
                $this->db->query($query);
                if($this->db->num_rows() > 0){
                	if($this->mailer->unsubscribe_mail($mail))
						$this->design->assign('error', 'Вы успешно отписались от рассылки');
                }else{
                    $this->design->assign('error', 'Email не найден в базе');
                }
            }else{
                $this->design->assign('error', 'Неверный Email');
            }
			$this->design->assign('hideform', 'y');
        }
        elseif($this->request->method('post') && $this->request->post('mailing_name') && $this->request->post('mailing_email'))
        {
			$mailing_name = trim($this->request->post('mailing_name'));
			$mailing_email = trim($this->request->post('mailing_email'));
			
			// antibot
			if($this->request->post('bttrue')) {
				$bttrue = $this->request->post('bttrue');
				$this->design->assign('bttrue', $bttrue);
			}	
			if($this->request->post('btfalse')) {
				$btfalse = $this->request->post('btfalse');
				$this->design->assign('btfalse', $btfalse);
			}
			// antibot end

			if($this->settings->spam_ip == 1 && (
					(!empty($ip) && $ip == $this->settings->last_ip_sub) || 
					(!empty(session_id()) && session_id() == $this->settings->session_id_sub)
				)){
				$this->design->assign('error', 'ip');
			}	
			elseif(!$bttrue)
				$this->design->assign('error', 'captcha');
			elseif($btfalse)
				$this->design->assign('error', 'captcha');
			elseif($this->settings->spam_cyr == 1 && !preg_match('/^[а-яё \t]+$/iu', $mailing_name))
				$this->design->assign('error', 'wrong_name');	
			elseif(!empty($this->settings->spam_symbols) && mb_strlen($mailing_name,'UTF-8') > $this->settings->spam_symbols)
				$this->design->assign('error', 'captcha');	
            elseif(filter_var($mailing_email, FILTER_VALIDATE_EMAIL))
            {
                $this->mailer->add_mail($mailing_name, $mailing_email);
				$this->design->assign('error', 'Вы успешно подписались на рассылку');
				
				// Записываем сессию и IP для блокировки повторной подписки
				if(!empty($ip))
					$this->settings->last_ip_sub = $ip;
				if(!empty(session_id()))
					$this->settings->session_id_sub = session_id();
            }
            else
            {
                $this->design->assign('error', 'Подписка невозможна');
            }
			$this->design->assign('hideform', 'y');
        }
		// Вход
		elseif($this->request->method('post') && $this->request->post('login'))
		{
            $login			= $this->request->post('user_login');
            $password		= $this->request->post('password');

            $this->design->assign('login', $login);

            if($user_id = (int) $this->users->check_password($login, $password))
            {
                $user = $this->users->get_user($user_id);
                if($user->enabled)
                {
                    $_SESSION['user_id'] = $user_id;
                    $this->users->update_user($user_id, array('last_ip'=>$ip));

                    if($this->settings->cart_storage == 2) {
                        $this->cart->base_to_cart($user_id);
                        $this->cart->cart_to_base();
                    }

                    // Перенаправляем пользователя на прошлую страницу, если она известна
                    /*if(!empty($_SESSION['current_for_login']))
                        header('Location: '.$_SESSION['current_for_login']);
                    else*/
                    header('Location: '.$this->config->root_url.'/user');
                }
                else
                {
                    $this->design->assign('error', 'user_disabled');
                }
            }
            else
            {
                $this->design->assign('error', 'login_incorrect');
            }
		}	
		return $this->design->fetch('login.tpl');
	}	
}

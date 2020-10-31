<?php

class Notify extends Fivecms
{
    /**
     * @deprecated
     * @param $phone string
     * @param $smstext string
     */
	public function sms($phone, $smstext){
		require_once('sms/sms.ru.php');
		$smsru = new SMSRU($this->settings->apiid);
		$data = new stdClass();
		$data->to = $phone;
		$data->text = $smstext;
		$data->from = $this->settings->apifrom;
		$data->partner_id = '15587'; 
		$sms = $smsru->send_one($data); 
	}

    /**
     * Отправляет смс код активашии юзеру
     * @param $user
     * @return false|string
     */
    public function send_sms_code($user)
    {
        $code = rand(10000, 99999);

        $confirm = [
            'user_id' => $user->id,
            'phone' => $user->phone,
            'code' => $code
        ];

        $this->db->query("INSERT INTO __users_confirm_sms SET ?%", $confirm);
        $_SESSION['confirm_id'] = $this->db->insert_id();

        return $this->send_sms_message($user->phone, "Ваш код $code");
    }

    /**
     * Проверяет отправлен ли юзеру смс код
     * @param $phone string
     * @param $user_id int
     * @return bool
     */
    public function check_sms_send($phone, $user_id)
    {
        $this->db->query("SELECT is_activate FROM __users_confirm_sms WHERE phone=? AND user_id=?", $phone, (int)$user_id);
        $res = $this->db->result();
        if (!$res) return false;
        return !$res->is_activate;
    }

    /**
     * Проверяет смс код
     * @param $code string
     * @return false|stdClass
     */
    public function check_sms_code($code)
    {
        $this->db->query("SELECT * FROM __users_confirm_sms WHERE id=?", (int)$_SESSION['confirm_id']);
        $confirm = $this->db->result();
        if ($confirm && $confirm->code == $code) {
            return $confirm;
        }
        $this->db->query("SELECT * FROM __users_confirm_sms WHERE user_id=? AND code=?", (int)$_SESSION['user_id'], $code);
        return $this->db->result();
    }

    public function activate_confirm()
    {
        $this->db->query("UPDATE __users_confirm_sms SET is_activate=1 WHERE id=?", (int)$_SESSION['confirm_id']);
        unset($_SESSION['confirm_id']);
    }

    /**
     * Отправляет смс на номер телефона сервис StreamTelecom
     * @param $phone string
     * @param $message string
     * @return false|string
     */
    public function send_sms_message($phone, $message)
    {
        $data = [
            'user' => $this->settings->apiid,
            'pwd' => $this->settings->apipass,
            'sadr' => $this->settings->apifrom,
            'dadr' => $phone,
            'text' => $message
        ];
        return file_get_contents('http://gateway.api.sc/get?' . http_build_query($data));
    }

    function email($to, $subject, $message, $from = '', $reply_to = '')
    {
		$email_header_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_header.tpl');
		$email_footer_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_footer.tpl');
		$fullmessage = $email_header_template;
		$fullmessage .= $message;
		$fullmessage .= $email_footer_template;
		$to = explode(',', $to);

		if ($this->settings->smtp_enable == 1) {
			require_once 'PHPMailer/Exception.php';
			require_once 'PHPMailer/PHPMailer.php';
			require_once 'PHPMailer/SMTP.php';
			$mailer = new PHPMailer\PHPMailer\PHPMailer;
			$mailer->SMTPDebug = 0;
			$mailer->CharSet = "utf-8";
			$mailer->IsSMTP();
			$mailer->Host = $this->settings->smtp_host;
			$mailer->SMTPAuth = true;
			$mailer->Username = $this->settings->smtp_user;
			$mailer->Password = $this->settings->smtp_password;
			if ($this->settings->smtp_ssl == 2) {
				$mailer->SMTPSecure = "tls";
			} elseif ($this->settings->smtp_ssl == 1) {
				$mailer->SMTPSecure = "ssl";
			}
			$mailer->Port = $this->settings->smtp_port;
			foreach($to as $to_item)
				$mailer->AddAddress(str_replace(' ', '', $to_item));
			$mailer->From = $from;
			$mailer->FromName = $this->settings->site_name;
			$mailer->Sender = $from;
			if ($reply_to) $mailer->AddReplyTo($reply_to, $reply_to);
			$mailer->IsHTML(true);
			$mailer->Subject = $subject;
			$mailer->Body = $fullmessage;
			try {
				$mailer->Send();
			} catch (Exception $e) {
				$mailer->smtp->reset();
			}
			$mailer->clearAddresses();
    		$mailer->clearAttachments();
		} else {
    		$headers = "MIME-Version: 1.0\n" ;
    		$headers .= "Content-type: text/html; charset=utf-8; \r\n"; 
    		$headers .= "From: $from\r\n";
    		if(!empty($reply_to)) $headers .= "reply-to: $reply_to\r\n";
			$subject = "=?utf-8?B?".base64_encode($subject)."?=";
			@mail($to, $subject, $fullmessage, $headers);
		}
    }

	public function email_order_user($order_id)
	{
			if(!($order = $this->orders->get_order(intval($order_id))) || empty($order->email))
				return false;
			
			$purchases = $this->orders->get_purchases(array('order_id'=>$order->id));
			$this->design->assign('purchases', $purchases);			

			$products_ids = array();
			$variants_ids = array();
			foreach($purchases as $purchase)
			{
				$products_ids[] = $purchase->product_id;
				$variants_ids[] = $purchase->variant_id;;
			}
			
			$products = array();
			//foreach($this->products->get_products(array('id'=>$products_ids)) as $p)
			foreach($this->products->get_products(array('id'=>$products_ids, 'limit' => count($products_ids))) as $p)
				$products[$p->id] = $p;
				
			$images = $this->products->get_images(array('product_id'=>$products_ids));
			foreach($images as $image)
				$products[$image->product_id]->images[] = $image;
			
			$variants = array();
			foreach($this->variants->get_variants(array('id'=>$variants_ids)) as $v)
			{
				$variants[$v->id] = $v;
				$products[$v->product_id]->variants[] = $v;
			}
				
			foreach($purchases as &$purchase)
			{
				if(!empty($products[$purchase->product_id]))
					$purchase->product = $products[$purchase->product_id];
				if(!empty($variants[$purchase->variant_id]))
					$purchase->variant = $variants[$purchase->variant_id];
				if(!empty($purchase->product->brand_id))
					$purchase->brand = $this->brands->get_brand(intval($purchase->product->brand_id));
			}
			
			// Способ доставки
			$delivery = $this->delivery->get_delivery($order->delivery_id);
			$this->design->assign('delivery', $delivery);

	        $payment_method = $this->payment->get_payment_method($order->payment_method_id);
    	    $this->design->assign('payment_method', $payment_method);

			$this->design->assign('order', $order);
			$this->design->assign('purchases', $purchases);

			// Отправляем письмо
			// Если в шаблон не передавалась валюта, передадим
			if ($this->design->smarty->getTemplateVars('currency') === null) 
			{
				//$this->design->assign('currency', reset($this->money->get_currencies(array('enabled'=>1))));
				$this->design->assign('currency', current($this->money->get_currencies(array('enabled'=>1))));
			}
			$email_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_order.tpl');
			$subject = $this->design->get_var('subject');
			$this->email($order->email, $subject, $email_template, $this->settings->notify_from_email, $this->settings->order_email);
	
			// Отправка смс уведомления пользователю
			$textstatus = "";
			if($order->status==0) $textstatus = "ждет обработки";
			elseif($order->status==4) $textstatus = "в обработке";
			elseif($order->status==1) $textstatus = "выполняется";
			elseif($order->status==2) $textstatus = "выполнен";
			elseif($order->status==3) $textstatus = "отменен";
		
			if($this->settings->statussms == 1 && $order->phone)
				$this->notify->sms($order->phone, 'Заказ на сайте '.$this->settings->site_name.' #'.$order->id.' '.$textstatus);
	}


	public function email_order_admin($order_id)
	{
			if(!($order = $this->orders->get_order(intval($order_id))))
				return false;
			
			$purchases = $this->orders->get_purchases(array('order_id'=>$order->id));
			$this->design->assign('purchases', $purchases);			

			$products_ids = array();
			$variants_ids = array();
			foreach($purchases as $purchase)
			{
				$products_ids[] = $purchase->product_id;
				$variants_ids[] = $purchase->variant_id;
			}

			$products = array();
			//foreach($this->products->get_products(array('id'=>$products_ids)) as $p)
			foreach($this->products->get_products(array('id'=>$products_ids, 'limit' => count($products_ids))) as $p)
				$products[$p->id] = $p;

			$images = $this->products->get_images(array('product_id'=>$products_ids));
			foreach($images as $image)
				$products[$image->product_id]->images[] = $image;
			
			$variants = array();
			foreach($this->variants->get_variants(array('id'=>$variants_ids)) as $v)
			{
				$variants[$v->id] = $v;
				$products[$v->product_id]->variants[] = $v;
			}
	
			foreach($purchases as &$purchase)
			{
				if(!empty($products[$purchase->product_id]))
					$purchase->product = $products[$purchase->product_id];
				if(!empty($variants[$purchase->variant_id]))
					$purchase->variant = $variants[$purchase->variant_id];
				if(!empty($purchase->product->brand_id))
					$purchase->brand = $this->brands->get_brand(intval($purchase->product->brand_id));
			}
			
			// Способ доставки
			$delivery = $this->delivery->get_delivery($order->delivery_id);
			$this->design->assign('delivery', $delivery);

			$this->design->assign('order', $order);
			$this->design->assign('purchases', $purchases);

			// В основной валюте
			$this->design->assign('main_currency', $this->money->get_currency());

			// Отправляем письмо
			$email_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_order_admin.tpl');
			$subject = $this->design->get_var('subject');
			$this->email($this->settings->order_email, $subject, $email_template, $this->settings->notify_from_email, $order->email);
			
		// Отправка смс уведомления администратору о поступившем заказе 
		if($this->settings->allowsms == 1 && $this->settings->smsadmin)
			$this->notify->sms($this->settings->smsadmin, 'На сайте '.$this->settings->site_name.' поступил заказ #'.$order->id.' на '.$order->total_price);
	
	}


	public function email_comment_admin($comment_id)
	{ 
			if(!($comment = $this->comments->get_comment(intval($comment_id))))
				return false;

			if($comment->type == 'product')
				$comment->product = $this->products->get_product(intval($comment->object_id));
			if($comment->type == 'blog')
				$comment->post = $this->blog->get_post(intval($comment->object_id));

			$this->design->assign('comment', $comment);

			// Отправляем письмо
			$email_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_comment_admin.tpl');
			$subject = $this->design->get_var('subject');
			$this->email($this->settings->comment_email, $subject, $email_template, $this->settings->notify_from_email, $comment->email);
	}


	public function email_comment_user($comment_id)
	{ 
			if(!($comment = $this->comments->get_comment(intval($comment_id))))
				return false;

			$this->design->assign('comment', $comment);
		
			if($comment->type == 'product')
			{
				$products = array();
				$products_ids = array();
				$products_ids[] = $comment->object_id;
				foreach($this->products->get_products(array('id'=>$products_ids)) as $p)
					$products[$p->id] = $p;
				if(isset($products[$comment->object_id]))
					$comment->product = $products[$comment->object_id];
			}

			if($comment->type == 'blog')
			{
				$posts = array();
				$posts_ids = array();
				$posts_ids[] = $comment->object_id;
				foreach($this->blog->get_posts(array('id'=>$posts_ids)) as $p)
					$posts[$p->id] = $p;
				if(isset($posts[$comment->object_id]))
					$comment->post = $posts[$comment->object_id];
			}

			$email_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_comment_user.tpl');
			$subject = $this->design->get_var('subject');
			$this->email($comment->email, $subject, $email_template, $this->settings->notify_from_email);
	}


	public function email_password_remind($user_id, $code)
	{
			if(!($user = $this->users->get_user(intval($user_id))))
				return false;
			
			$this->design->assign('user', $user);
			$this->design->assign('code', $code);

			// Отправляем письмо
			$email_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_password_remind.tpl');
			$subject = $this->design->get_var('subject');
			$this->email($user->email, $subject, $email_template, $this->settings->notify_from_email);
			
			$this->design->smarty->clearAssign('user');
			$this->design->smarty->clearAssign('code');
	}

	public function email_feedback_admin($feedback_id)
	{ 
			if(!($feedback = $this->feedbacks->get_feedback(intval($feedback_id))))
				return false;

			$this->design->assign('feedback', $feedback);

			// Отправляем письмо
			$email_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_feedback_admin.tpl');
			$subject = $this->design->get_var('subject');
			$this->email($this->settings->comment_email, $subject, $email_template, $this->settings->notify_from_email, $feedback->email);
	}

	public function email_user_registration($user_id, $password)
	{
			if(!($user = $this->users->get_user(intval($user_id))))
				return false;
			
			$this->design->assign('user', $user);
			$this->design->assign('password', $password);

			// Отправляем письмо
			$email_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_user_registration.tpl');
			$subject = $this->design->get_var('subject');
			$this->email($user->email, $subject, $email_template, $this->settings->notify_from_email);
			
			$this->design->smarty->clearAssign('user');
            $this->design->smarty->clearAssign('password');
	}

	public function email_mailer_confirm($name, $email)
	{
    		$this->design->assign('mail', $email);
			$this->design->assign('name', $name);
			$message = '<p>Вы успешно подписались на нашу информационную рассылку.</p>';
			$message .= '<p>Если вы не делали этого, то просто перейдите по ссылке внизу письма, чтобы отписаться.</p>';
			$this->design->assign('message', $message);
			$email_template = $this->design->fetch($this->config->root_dir.'design/mail/html/email_mailer.tpl');
			$subject = 'Подтверждение подписки на рассылку';
			$this->email($email, $subject, $email_template, $this->settings->notify_from_email);
	}

}

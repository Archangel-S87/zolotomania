<?PHP

/**
 *
 * @copyright 	5CMS
 * @link 		http://5cms.ru
 *
 */
 
require_once('View.php');

class UserView extends View
{
	function fetch()
	{
		if(empty($this->user))
		{
			header('Location: '.$this->config->root_url.'/user/login');
			exit();
		}
	
		if($this->request->method('post') && $this->request->post('name'))
		{
			$name			= $this->request->post('name');
			$email			= $this->request->post('email');
			$phone			= $this->request->post('phone');
			$password		= $this->request->post('password');
			$adress			= $this->request->post('adress');
			
			$this->design->assign('name', $name);
			$this->design->assign('email', $email);
			$this->design->assign('phone', $phone);
			$this->design->assign('adress', $adress);
			
			$this->db->query('SELECT count(*) as count FROM __users WHERE email=? AND id!=?', $email, $this->user->id);
			$user_exists = $this->db->result('count');

			if($user_exists)
				$this->design->assign('error', 'user_exists');
			elseif(empty($name))
				$this->design->assign('error', 'empty_name');
			elseif(empty($email))
				$this->design->assign('error', 'empty_email');
			elseif(empty($phone))
				$this->design->assign('error', 'empty_phone');
			elseif(empty($adress))
				$this->design->assign('error', 'empty_adress');
			elseif($user_id = $this->users->update_user($this->user->id, array('name'=>$name, 'email'=>$email, 'phone'=>$phone, 'adress'=>$adress)))
			{
				$this->user = $this->users->get_user(intval($user_id));
				$this->design->assign('name', $this->user->name);
				$this->design->assign('user', $this->user);
				$this->design->assign('email', $this->user->email);			
				$this->design->assign('phone', $this->user->phone);
				$this->design->assign('adress', $this->user->adress);		
			}
			else
				$this->design->assign('error', 'unknown error');
			
			if(!empty($password))
			{
				$this->users->update_user($this->user->id, array('password'=>$password));
			}
	
		}
		else
		{
			// Передаем в шаблон
			$this->design->assign('name', $this->user->name);
			$this->design->assign('email', $this->user->email);	
			$this->design->assign('phone', $this->user->phone);	
			$this->design->assign('adress', $this->user->adress);		
		}
	
		$orders = $this->orders->get_orders(array('user_id'=>$this->user->id));
		$this->design->assign('orders', $orders);
		
		$referrals = $this->users->get_users(array('partner_id'=>$this->user->id));
		$this->design->assign('referrals', $referrals);
		
		$this->design->assign('meta_title', $this->user->name);

		$body = $this->design->fetch('user.tpl');
		
		return $body;
	}
}

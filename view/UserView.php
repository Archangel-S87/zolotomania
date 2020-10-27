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
            $tel			= $this->request->post('tel');
			$password		= $this->request->post('password');
			$address			= $this->request->post('address');
			
			$this->design->assign('name', $name);
			$this->design->assign('email', $email);
			$this->design->assign('address', $address);

            $phone = str_replace(['(', ')', ' ', '-'], '', $tel);
            $this->design->assign('phone', $tel);

            if ($email) {
                $this->db->query('SELECT count(*) as count FROM __users WHERE email=? AND id!=?', $email, $this->user->id);
                $this->design->assign('user_exists_message', 'email');
            } elseif ($email && $phone) {
                $this->db->query('SELECT count(*) as count FROM __users WHERE email=? AND phone!=? AND id=?', $email, $phone, $this->user->id);
                $this->design->assign('user_exists_message', '');
            } else {
                $this->db->query('SELECT count(*) as count FROM __users WHERE phone=? AND id!=?', $phone, $this->user->id);
                $this->design->assign('user_exists_message', 'phone');
            }

			$user_exists = $this->db->result('count');

			if($user_exists)
				$this->design->assign('error', 'user_exists');
			elseif(empty($name))
				$this->design->assign('error', 'empty_name');
            elseif(empty($tel))
                $this->design->assign('error', 'empty_tel');
            elseif(!preg_match('/^\+7[\d]{5,15}$/i', $phone))
                $this->design->assign('error', 'invalid_tel');
			elseif($user_id = $this->users->update_user($this->user->id, array('name'=>$name, 'email'=>$email, 'phone'=>$phone, 'address'=>$address)))
			{
				$this->user = $this->users->get_user(intval($user_id));
				$this->design->assign('name', $this->user->name);
				$this->design->assign('user', $this->user);
				$this->design->assign('email', $this->user->email);			
				$this->design->assign('phone', $this->user->phone);
				$this->design->assign('address', $this->user->address);
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
			$this->design->assign('address', $this->user->address);
		}
	
		$orders = $this->orders->get_orders(array('user_id'=>$this->user->id));
		$this->design->assign('orders', $orders);
		
		$referrals = $this->users->get_users(array('partner_id'=>$this->user->id));
		$this->design->assign('referrals', $referrals);
		
		$this->design->assign('meta_title', $this->user->name);
		
		return $this->design->fetch('user.tpl');
	}
}

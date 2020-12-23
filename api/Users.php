<?php

require_once('Fivecms.php');

class Users extends Fivecms
{
    // осторожно, при изменении соли испортятся текущие пароли пользователей
    private $salt = '8e86a279d6e182b3c811c559e6t15f84';

    function get_users($filter = array())
    {
        $limit = 1000;
        $page = 1;
        $group_id_filter = '';
        $keyword_filter = '';
        $partner_filter = '';

        if (isset($filter['limit']))
            $limit = max(1, intval($filter['limit']));

        if (isset($filter['page']))
            $page = max(1, intval($filter['page']));

        if (isset($filter['group_id']))
            $group_id_filter = $this->db->placehold('AND u.group_id in(?@)', (array)$filter['group_id']);

        if (isset($filter['keyword']) AND !empty($filter['keyword'])) {
            $keywords = explode(' ', $filter['keyword']);
            foreach ($keywords as $keyword) {
                $keyword_filter .= $this->db->placehold('AND (u.name LIKE "%' . $this->db->escape(trim($keyword)) . '%" OR u.email LIKE "%' . $this->db->escape(trim($keyword)) . '%")');
            }
        }

        if (isset($filter['partner_id']))
            $partner_filter = $this->db->placehold('AND u.partner_id = ?', intval($filter['partner_id']));

        $order = 'u.name';
        if (!empty($filter['sort']))
            switch ($filter['sort']) {
                case 'date':
                    $order = 'u.created DESC';
                    break;
                case 'views':
                    $order = 'u.ref_views DESC';
                    break;
                case 'balance':
                    $order = 'u.balance DESC';
                    break;
                case 'group':
                    $order = 'group_name DESC';
                    break;
                case 'name':
                    $order = 'u.name';
                    break;
            }

        $sql_limit = $this->db->placehold(' LIMIT ?, ? ', ($page - 1) * $limit, $limit);
        // Выбираем пользователей
        $query = $this->db->placehold("SELECT u.id, u.email, u.password, u.name, u.address, u.balance, u.group_id, u.enabled, u.last_ip, u.created, u.order_payd, u.phone, u.partner_id, u.ref_views, g.discount, g.name as group_name FROM __users u
		                                LEFT JOIN __groups g ON u.group_id=g.id 
										WHERE 1 $group_id_filter $keyword_filter $partner_filter ORDER BY $order $sql_limit");
        $this->db->query($query);

        $uu = $this->db->results();
        if (is_array($uu)) foreach ($uu as $k => $u) {
            $uu[$k]->tdiscount = $this->get_tdiscount($u->order_payd);
        }

        return $uu;

    }

    function count_users($filter = array())
    {
        $group_id_filter = '';
        $keyword_filter = '';

        if (isset($filter['group_id']))
            $group_id_filter = $this->db->placehold('AND u.group_id in(?@)', (array)$filter['group_id']);

        if (isset($filter['keyword']) AND !empty($filter['keyword'])) {
            $keywords = explode(' ', $filter['keyword']);
            foreach ($keywords as $keyword) {
                $keyword_filter .= $this->db->placehold('AND u.name LIKE "%' . $this->db->escape(trim($keyword)) . '%" OR u.email LIKE "%' . $this->db->escape(trim($keyword)) . '%"');
            }
        }

        // Выбираем пользователей
        $query = $this->db->placehold("SELECT count(*) as count FROM __users u
		                                LEFT JOIN __groups g ON u.group_id=g.id 
										WHERE 1 $group_id_filter $keyword_filter ORDER BY u.name");
        $this->db->query($query);
        return $this->db->result('count');
    }

    function get_user($id)
    {
        if (gettype($id) == 'string')
            $where = $this->db->placehold(' WHERE u.phone=? ', $id);
        else
            $where = $this->db->placehold(' WHERE u.id=? ', intval($id));

        // Выбираем пользователя
        $query = $this->db->placehold("SELECT u.id, u.email, u.password, u.name, u.address, u.balance, u.group_id, u.enabled, u.last_ip, u.created, u.order_payd, u.phone, u.partner_id, u.comment, u.withdrawal, u.ref_views, g.discount, g.name as group_name FROM __users u LEFT JOIN __groups g ON u.group_id=g.id $where LIMIT 1", $id);
        $this->db->query($query);
        $user = $this->db->result();

        if (empty($user)) return false;

        $user->discount *= 1; // Убираем лишние нули, чтобы было 5 вместо 5.00
        $user->tdiscount = $this->get_tdiscount($user->order_payd);
        $user->tdiscount *= 1; // Убираем лишние нули, чтобы было 5 вместо 5.00
        return $user;
    }

    public function get_user_data($id)
    {
        $this->db->query('SELECT * FROM __users_data WHERE id=? LIMIT 1', (int)$id);
        return $this->db->result();
    }

    public function add_user_data($id, $data) {
        $data = (array)$data;
        $data['id'] = $id;
        $this->db->query("INSERT INTO __users_data SET ?% ON DUPLICATE KEY UPDATE id=?", $data, $id);
        return $id;
    }

    public function update_user_data($id, $data)
    {
        $data = (array)$data;
        $this->db->query("SELECT count(*) as count FROM __users_data WHERE id=?", $id);

        if ($this->db->result('count') > 0) {
            $this->db->query("UPDATE __users_data SET ?% WHERE id=?", $data, $id);
        } else {
            $this->add_user_data($id, $data);
        }

        return $id;
    }

    public function add_user($user)
    {
        $user = (array)$user;
        if (isset($user['password']))
            $user['password'] = md5($this->salt . $user['password'] . md5($user['password']));

        $query = $this->db->placehold("SELECT count(*) as count FROM __users WHERE phone=?", $user['phone']);
        $this->db->query($query);

        if ($this->db->result('count') > 0)
            return false;

        $query = $this->db->placehold("INSERT INTO __users SET ?%", $user);
        $this->db->query($query);

        if ($user_id = $this->db->insert_id()) {
            $this->add_user_data($user_id, new stdClass());
        }

        return $user_id;
    }

    public function update_user($id, $user)
    {
        $user = (array)$user;
        if (isset($user['password']))
            $user['password'] = md5($this->salt . $user['password'] . md5($user['password']));
        $query = $this->db->placehold("UPDATE __users SET ?% WHERE id=? LIMIT 1", $user, intval($id));
        $this->db->query($query);
        return $id;
    }

    /*
    *
    * Удалить пользователя
    * @param $post
    *
    */
    public function delete_user($id)
    {
        if (!empty($id)) {
            $query = $this->db->placehold("UPDATE __orders SET user_id=NULL WHERE user_id=?", intval($id));
            $this->db->query($query);

            $query = $this->db->placehold("DELETE FROM __surveys_results WHERE user_id=?", intval($id));
            $this->db->query($query);

            $query = $this->db->placehold("DELETE FROM __users WHERE id=? LIMIT 1", intval($id));
            if ($this->db->query($query))
                $this->db->query("DELETE FROM __users_data WHERE id=? LIMIT 1", intval($id));
                return true;
        }
        return false;
    }

    function get_groups()
    {
        // Выбираем группы
        $query = $this->db->placehold("SELECT * FROM __groups AS g ORDER BY g.discount");
        $this->db->query($query);
        return $this->db->results();
    }

    function get_group($id)
    {
        // Выбираем группу
        $query = $this->db->placehold("SELECT * FROM __groups WHERE id=? LIMIT 1", $id);
        $this->db->query($query);
        $group = $this->db->result();

        return $group;
    }

    public function add_group($group)
    {
        $query = $this->db->placehold("INSERT INTO __groups SET ?%", $group);
        $this->db->query($query);
        return $this->db->insert_id();
    }

    public function update_group($id, $group)
    {
        $query = $this->db->placehold("UPDATE __groups SET ?% WHERE id=? LIMIT 1", $group, intval($id));
        $this->db->query($query);
        return $id;
    }

    public function delete_group($id)
    {
        if (!empty($id)) {
            $query = $this->db->placehold("UPDATE __users SET group_id=NULL WHERE group_id=? LIMIT 1", intval($id));
            $this->db->query($query);

            $query = $this->db->placehold("DELETE FROM __groups WHERE id=? LIMIT 1", intval($id));
            if ($this->db->query($query))
                return true;
        }
        return false;
    }

    public function check_password($login, $password)
    {
        $encpassword = md5($this->salt . $password . md5($password));
        if (stripos($login, '@') !== false) {
            $query = $this->db->placehold("SELECT id FROM __users WHERE email=? AND password=? LIMIT 1", $login, $encpassword);
        } else {
            $login = str_replace([' ', '(', ')', '-'], '', $login);
            $query = $this->db->placehold("SELECT id FROM __users WHERE phone=? AND password=? LIMIT 1", $login, $encpassword);
        }
        $this->db->query($query);
        if ($id = $this->db->result('id'))
            return $id;
        return false;
    }

    public function get_tdiscount($sum)
    {
        $t = $this->settings->discount_table;
        $t = explode(';', $t);
        $td = 0;
        for ($i = 0; $i < count($t); $i += 2) {
            if ($sum > $t[$i])
                $td = $t[$i + 1];
        }
        return $td;
    }

    public function update_ref_views($id)
    {
        $this->db->query("UPDATE __users SET ref_views=ref_views+1 WHERE id=?", $id);
        return true;
    }

}

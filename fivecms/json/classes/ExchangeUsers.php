<?php

/*
 * Импорт и экспорт пользователей
 */


class ExchangeUsers extends Exchange
{
    protected $mods = [
        'import',
        'export',
        'delete'
    ];

    /**
     * Группы юзеров
     * @var array
     */
    private $groups = [];


    protected function export()
    {
        $this->db->query("SELECT u.email, u.password, u.name, u.balance, u.created, u.order_payd, u.phone, u.partner_id, u.ref_views, g.name as group_name, g.external_id as group_id FROM __users as u LEFT JOIN __groups as g ON u.group_id = g.id WHERE u.external_id = u.phone");
        $db_users = $this->db->results();

        $users = [];

        foreach ($db_users as $db_user) {
            $user = (array)$db_user;

            $this->db->query('SELECT external_id FROM __users WHERE id=? LIMIT 1', $user['partner_id']);
            $user['partner_id'] = $this->db->result('external_id') ?: null;

            $users[] = $user;
        }

        Exchange::response(['users' => $users]);
    }

    protected function import()
    {
        $filename = $this->check_import_file();

        require_once JSON_READER . 'autoload.php';
        $reader = new pcrov\JsonReader\JsonReader();

        try {
            $reader->open($this->temp_dir . $filename);

            // Обновление списка групп
            if ($reader->read('Groups')) {

                $depth = $reader->depth();
                $reader->read();

                $import_group_ids = [];

                do {
                    $import_group_ids[] = $this->import_group($reader->value());
                } while ($reader->next() && $reader->depth() > $depth);

                // Удаляю не нужные группы
                if ($import_group_ids) {
                    $this->db->query('DELETE FROM __groups WHERE id NOT IN (?@)', $import_group_ids);
                }
            }

            // Обновлени пользователей
            if ($reader->read('Users')) {

                $depth = $reader->depth();
                $reader->read();

                $this->groups = $this->users->get_groups();

                do {
                    $this->import_user($reader->value());
                } while ($reader->next() && $reader->depth() > $depth);
            }
        } catch (Exception $exception) {
            Exchange::error_read_file($filename, $exception);
        }

        $reader->close();

        Exchange::response();
    }

    /**
     * Очищает таблицу юзеров
     */
    protected function delete()
    {
        // Список юзеров не подлежащих удалению
        $users_id = [1];
        $this->db->query("SELECT * FROM __users WHERE id IN (?@)", $users_id);
        $users = $this->db->results();

        $this->db->query('TRUNCATE TABLE __users');

        foreach ($users as $user) {
            $user = (array)$user;
            unset($user['id']);
            $this->db->query("INSERT INTO __users SET ?%", $user);
        }

        Exchange::response();
    }

    /**
     * Импортирует или удаляет юзера
     * @param $json_user
     */
    private function import_user($json_user)
    {
        if ($json_user['Статус'] == 'DELETE') {
            $this->db->query('SELECT id FROM __users WHERE external_id=? LIMIT 1', $json_user['Ид']);
            $id = $this->db->result('id');

            // Оставляю админа
            if ($id && $id != 1) $this->db->query('DELETE FROM __users WHERE id=?', $id);
            return;
        }

        if (!$json_user['Телефон']) {
            Exchange::add_warning("User with id {$json_user['Ид']} does not have a phone");
            return;
        }

        $this->db->query('SELECT id, email, password, name, balance, group_id, enabled, order_payd, phone, partner_id, ref_views, external_id, bonus_type FROM __users WHERE external_id=? OR phone=? LIMIT 1', $json_user['Ид'], $json_user['Телефон']);
        $saved_user = (array)$this->db->result();

        // Временный пользователь для сравнения
        $user = [
            'email' => $json_user['Email'] ?? '',
            'password' => $json_user['password'],
            'name' => $json_user['ФИО'],
            'balance' => (float)$json_user['КоличествоБонусов'],
            'group_id' => $this->get_group_id($json_user['Группа']),
            'enabled' => 1,
            'order_payd' => (float)$json_user['ИтоговаяСуммаПокупок'],
            'phone' => $json_user['Телефон'],
            'partner_id' => $this->get_partner_id($json_user['partner_id']),
            'ref_views' => (int)$json_user['ref_views'],
            'external_id' => $json_user['Ид'],
            'bonus_type' => $json_user['ТипБонусов']
        ];

        if (!$saved_user) {
            // Добавление юзера
            $this->db->query("INSERT INTO __users SET ?%", $user);
            return;
        }

        $user['id'] = $saved_user['id'];

        // Приведение типов
        $saved_user['balance'] = (float)$saved_user['balance'];
        $saved_user['order_payd'] = (float)$saved_user['order_payd'];

        // Если есть что обновлять - обновляю
        if ($need_update = array_diff_assoc($user, $saved_user)) {
            $this->db->query("UPDATE __users SET ?% WHERE id=? LIMIT 1", $need_update, intval($user['id']));
        }
    }

    /**
     * @param $id
     * @return int
     */
    private function get_partner_id($id)
    {
        if (!$id) return 0;
        $this->db->query('SELECT id FROM __users WHERE external_id=? LIMIT 1', $id);
        return $this->db->result() ?: 0;
    }

    /**
     * @param $name
     * @return int
     */
    private function get_group_id($name)
    {
        foreach ($this->groups as $group) {
            if ($group->name == $name) return $group->id;
        }
        Exchange::add_warning("Group $name not found");
        return 0;
    }

    /**
     * @param $new_group
     * @return int
     */
    private function import_group($new_group)
    {
        $this->db->query('SELECT id FROM __groups WHERE external_id=? LIMIT 1', $new_group['Ид']);
        $id = $this->db->result('id');

        if ($id) return $id;

        $group = [
            'name' => $new_group['Имя'],
            'discount' => $new_group['Скидка'],
            'external_id' => $new_group['Ид']
        ];

        $query = $this->db->placehold('INSERT INTO __groups SET ?%', $group);
        $this->db->query($query);

        return $this->db->insert_id();
    }
}

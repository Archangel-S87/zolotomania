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
        // TODO добавить выгрузку всех юзеров без истории покупки
        $this->db->query("SELECT u.email, u.password, u.name, u.balance, u.created, u.order_payd, u.phone, u.partner_id, u.ref_views, g.name as group_name, g.external_id as group_id FROM __users as u LEFT JOIN __groups as g ON u.group_id = g.id WHERE u.external_id = u.phone");
        $db_users = $this->db->results();

        $users = [];

        foreach ($db_users as $db_user) {
            $user = (array)$db_user;

            if ($user['partner_id']) {
                $this->db->query('SELECT external_id FROM __users WHERE id=? LIMIT 1', $user['partner_id']);
                $user['partner_id'] = $this->db->result('external_id') ?: null;
            }

            $this->db->query('SELECT * FROM __users_data WHERE id=? LIMIT 1', $user['id']);
            $user_data = $this->db->result();
            if ($user_data) {
                $user_data = (array)$user_data;
                $user['birthday'] = $user_data['birthday'];
                unset($user_data['id']);
                unset($user_data['birthday']);
                $user['address'] = $user_data;
            }

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
            if ($reader->read('groups')) {

                $depth = $reader->depth();
                $reader->read();

                $import_group_ids = [];

                do {
                    if (!$reader->value()) continue;
                    $import_group_ids[] = $this->import_group($reader->value());
                } while ($reader->next() && $reader->depth() > $depth);

                // Удаляю не нужные группы
                if ($import_group_ids) {
                    $this->db->query('DELETE FROM __groups WHERE id NOT IN (?@)', $import_group_ids);
                }
            } else {
                Exchange::error('Список групп не найден');
            }

            $this->groups = $this->users->get_groups();

            // Обновление пользователей
            if ($reader->read('users')) {

                $depth = $reader->depth();
                $reader->read();

                do {
                    if (!$reader->value()) continue;
                    $this->import_user($reader->value());
                } while ($reader->next() && $reader->depth() > $depth);
            } else {
                Exchange::error('Список пользователей не найден');
            }
        } catch (Exception $exception) {
            Exchange::error_read_file($filename, $exception);
        }

        $reader->close();

        Exchange::response();
    }

    /**
     * @param $new_group
     * @return int
     */
    private function import_group($new_group)
    {
        $this->db->query('SELECT id FROM __groups WHERE external_id=? LIMIT 1', $new_group['id']);
        $id = $this->db->result('id');

        if ($id) return $id;

        if (empty($new_group['id']) || empty($new_group['name'])) {
            Exchange::add_warning("Некорректный формат объекта группы пользователя");
            return 0;
        }

        $group = [
            'name' => $new_group['name'],
            'discount' => $new_group['discount'] ?? 0,
            'external_id' => $new_group['id']
        ];

        $query = $this->db->placehold('INSERT INTO __groups SET ?%', $group);
        $this->db->query($query);

        return $this->db->insert_id();
    }

    /**
     * Импортирует или удаляет юзера
     * @param $json_user
     */
    private function import_user($json_user)
    {
        $default_user = [
            'id' => '',
            'phone' => '',
            'name' => '',
            'email' => '',
            'password' => '',
            'birthday' => null,
            'address_full' => '',
            'address' => [
                'region' => null,
                'district' => null,
                'city' => null,
                'street' => null,
                'house' => null,
                'apartment' => null
            ],
            'group_id' => 0,
            'enabled' => 1,
            'partner_id' => 0,
            'ref_views' => 0,
            'balance' => 0,
            'order_payd' => 0,
            'comment' => '',
            'withdrawal' => '',
        ];

        if (empty($json_user['id'])) {
            Exchange::add_warning("Не определён id пользователя");
            return;
        }

        // Удаление юзера
        if (isset($json_user['status']) && $json_user['status'] == 'DELETE') {
            $this->db->query('SELECT id FROM __users WHERE external_id=? LIMIT 1', $json_user['id']);
            $id = $this->db->result('id');

            // Оставляю админа
            if ($id && $id != 1) $this->db->query('DELETE FROM __users WHERE id=?', $id);
            return;
        }

        if (empty($json_user['phone'])) {
            Exchange::add_warning("Пользователь с id {$json_user['id']} не имеет номера телефона");
            return;
        }

        // Присвоение юзеру external_id не равный номеру телефона
        $new_external_id = isset($json_user['status']) && $json_user['status'] == 'UPDATE';
        if ($new_external_id) {
            $this->db->query('SELECT id FROM __users WHERE phone=? AND external_id=phone LIMIT 1', $json_user['phone']);
        } else {
            $this->db->query('SELECT id FROM __users WHERE external_id=? LIMIT 1', $json_user['id']);
        }
        $user_id = (int)$this->db->result('id');

        // Валидация
        $user = new stdClass();
        $user_data = new stdClass();
        foreach ($default_user as $key => $value) {
            if (!$user_id && !isset($json_user[$key]) && !in_array($key, ['birthday', 'address'])) {
                $user->$key = $value;
                continue;
            } elseif ($user_id && !isset($json_user[$key])) {
                continue;
            }

            $json_val = $default_user[$key];
            if (isset($json_user[$key]) && is_string($json_user[$key])) {
                $json_val = trim($json_user[$key]);
            }

            switch ($key) {
                case 'id':
                    $user->external_id = $json_val;
                    break;
                case 'balance':
                case 'order_payd':
                    $user->$key = (float)$json_val;
                    break;
                case 'group_id':
                    $user->$key = $this->get_group_id($json_val);
                    break;
                case 'address':
                    foreach ($default_user[$key] as $field => $val) {
                        $user_data->$field = trim($json_user[$key][$field] ?? null);
                    }
                    break;
                case 'address_full':
                    $user->address = $json_user['address_full'] ?? '';
                    break;
                case 'email':
                    $user->$key = mb_strtolower($json_val);
                    break;
                case 'birthday':
                    $user_data->birthday = $json_user['birthday'] ?? null;
                    break;
                case 'partner_id':
                    $user->$key = $this->get_partner_id($json_val);
                    break;
                case 'enabled':
                case 'ref_views':
                    $user->$key = (int)$json_val;
                    break;
                default:
                    $user->$key = $json_val;
            }
        }

        $user = (array)$user;

        // Добавление юзера
        if (!$user_id) {
            $this->db->query("INSERT INTO __users SET ?%", $user);
            if (!$user_id = $this->db->insert_id()) {
                Exchange::add_warning("Пользователь с id {$json_user['id']} и номером телефона {$json_user['phone']} не добавлен");
            } else {
                $this->users->update_user_data($user_id, $user_data);
            }
            return;
        }

        // Обновление юзера
        $this->db->query("UPDATE __users SET ?% WHERE id=?", $user, $user_id);
        $this->users->update_user_data($user_id, $user_data);

        // Обновление заказов юзера
        if ($new_external_id) {
            foreach ($this->orders->get_orders(['user_id' => $user_id]) ?: [] as $order) {
                $this->orders->update_order($order->id, ['user_external_id' => $user->external_id]);
            }
        }
    }

    /**
     * @param $external_id string
     * @return int
     */
    private function get_group_id($external_id)
    {
        if (!$external_id) return 0;
        foreach ($this->groups as $group) {
            if ($group->external_id == $external_id) return $group->id;
        }
        Exchange::add_warning("Группа {$external_id} не найдена");
        return 0;
    }

    /**
     * @param $external_id string
     * @return int
     */
    private function get_partner_id($external_id)
    {
        if (!$external_id) return 0;
        $this->db->query('SELECT id FROM __users WHERE external_id=? LIMIT 1', $external_id);
        return $this->db->result() ?: 0;
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
}

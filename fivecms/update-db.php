<?php

error_reporting(E_ALL);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');

require_once '../api/Fivecms.php';


class UpdateDB extends Fivecms
{
    private $site_id;
    private $tables;

    public function __construct()
    {
        parent::__construct();

        $this->site_id = md5(getenv("HTTP_HOST"));

        // Добавление таблчци магазины
        $this->create_table_shops();

        // Модификацмя таблицы заказы
        $this->update_table_orders();

        // Модификацмя таблицы заказы
        $this->update_table_variants();

        // Создание таблицы запросов CMS
        $this->create_table_users_confirm_sms();

        // Обновление таблицы групп пользователей
        //$this->update_table_groups();

        // Обновление таблицы __users
        //$this->update_table_users();
        echo 0;
    }

    private function create_table_users_confirm_sms()
    {
        if ($this->check_table('users_confirm_sms')) return;
        $table_name = $this->config->db_prefix . 'users_confirm_sms';
        $this->db->query("CREATE TABLE {$table_name} ( `id` INT(11) NOT NULL AUTO_INCREMENT, `user_id` INT(11) NOT NULL, `phone` VARCHAR(45) NOT NULL, `code` INT(5) NOT NULL, `is_send` TINYINT(1) NOT NULL DEFAULT '1', `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE = MyISAM;");
    }

    private function create_table_shops()
    {
        if ($this->check_table('shops')) return;
        $table_name = $this->config->db_prefix . 'shops';
        $this->db->query("CREATE TABLE {$table_name} (`id` INT(11) NOT NULL AUTO_INCREMENT, `external_id` VARCHAR(74) NOT NULL, `name` VARCHAR(100) NOT NULL, `address` VARCHAR(200) NOT NULL, `city` VARCHAR(50) NOT NULL, PRIMARY KEY (`id`)) ENGINE = MyISAM;");
    }

    private function update_table_orders()
    {
        if (!$this->check_column('shop_id', 'orders')) {
            $this->db->query("ALTER TABLE __orders ADD shop_id INT(4) NOT NULL");
        }

        // Возможен пустой email
        $this->db->query("ALTER TABLE __orders CHANGE email email VARCHAR(255) NULL");
    }

    private function update_table_variants()
    {
        if (!$this->check_column('shop_id', 'variants')) {
            $this->db->query("ALTER TABLE __variants ADD shop_id INT(4) NOT NULL");
        }

        if (!$this->check_column('reservation', 'variants')) {
            $this->db->query("ALTER TABLE __variants ADD reservation TINYINT(1) DEFAULT 0 NOT NULL");
        }
    }

    private function update_table_groups()
    {
        if ($this->check_column('external_id', 'groups')) return;
        $this->db->query("ALTER TABLE __groups ADD external_id varchar(64)");
    }

    private function update_table_users()
    {
        $table_mame = 'users';

        // добавление колонок
        if (!$this->check_column('external_id', $table_mame)) {
            $this->db->query("ALTER TABLE __{$table_mame} ADD external_id varchar(74) NOT NULL COMMENT 'ИД 1С'");
        }

        if (!$this->check_column('site_id', $table_mame)) {
            $this->db->query("ALTER TABLE __{$table_mame} ADD site_id varchar(64) NOT NULL DEFAULT '{$this->site_id}' COMMENT 'ИдСайта'");
        }

        if (!$this->check_column('bonus_type', $table_mame)) {
            $this->db->query("ALTER TABLE __{$table_mame} ADD bonus_type varchar(100) DEFAULT NULL COMMENT 'ТипБонусов'");
        }

        // Обноление индекса
        if (!$this->check_index('phone', $table_mame)) {
            $this->db->query("ALTER TABLE __{$table_mame} ADD UNIQUE (`phone`)");
        }

        if (!$this->check_index('external_id', $table_mame)) {
            $this->db->query("ALTER TABLE __{$table_mame} ADD UNIQUE (`external_id`)");
        }

    }

    private function check_table($table_name)
    {
        $table_name = $this->config->db_prefix . $table_name;

        if (!$this->tables) {
            $this->db->query("SHOW TABLES");
            $this->tables = $this->db->results();
        }

        $find_table = false;
        foreach ($this->tables as $table) {
            $keys = get_object_vars($table);
            foreach ($keys as $name) {
                if ($name == $table_name) $find_table = true;
            }
            if ($find_table) break;
        }

        return $find_table;
    }

    private function check_index($index, $table)
    {
        $this->db->query("SHOW INDEX FROM __{$table}");
        $is = $this->db->results();

        foreach ($is as $i) {
            if ($i->Column_name == $index) return true;
        }

        return false;
    }

    private function check_column($name, $table)
    {
        $this->db->query("DESCRIBE __{$table}");
        $columns = $this->db->results();

        foreach ($columns as $column) {
            if ($column->Field == $name) return true;
        }

        return false;
    }

}

$update = new UpdateDB();

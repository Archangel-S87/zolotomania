<?php

/**
 * Extension: json_1c_exchange
 * Description: Расширения для синхронизации 1c бухгалтерия и 5cms
 * Author: Sergey Sluka
 * Version: 1.0.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

const JSON_DIR = __DIR__ . '/';
const JSON_READER = JSON_DIR . 'JsonReader/vendor/';

chdir('../..');
require_once JSON_DIR . 'classes/Exchange.php';


$exchange = new Exchange();

if ($exchange->start_type()) {

    ini_set('max_execution_time', 0);
    set_time_limit(0);

    session_start();

    $exchange->start_mode();

} else {
    Exchange::error('Please check the documentation or contact the developer.');
}

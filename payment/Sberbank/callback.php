<?php

/*
 * T4632247232-api T4632247232
 * токен для использования в запросах 55psnbbg3thon7g2jgd433vok4
 * Ключ для расшифровки контрольной суммы в Callback : atmiumq7192mp5bob3p8u0189o
 */

// Работаем в корневой директории
chdir ('../../');
require_once('api/Fivecms.php');
require_once('payment/Sberbank/Sberbank.php');
$fivecms = new Fivecms();
$sberbank = new Sberbank();

function c_log($message) {
    global $fivecms;
    $data = ['warning' => $message];
    $data = array_merge($data, $_GET);
    $fivecms->notify->print_log(__DIR__, 'callback.log', $data);
    die();
}

$checksum = $fivecms->request->get('checksum');
$mdOrder = $fivecms->request->get('mdOrder');
$operation = $fivecms->request->get('operation');
$orderNumber = $fivecms->request->get('orderNumber');
$status = $fivecms->request->get('status');

$fivecms->db->query('SELECT order_id FROM __payments_sber WHERE order_sber=? LIMIT 1', $mdOrder);
$order_id = (int)$fivecms->db->result('order_id');

$order = $fivecms->orders->get_order($order_id);
if (!$order) c_log('Не найден ордер');

if($order->paid) c_log('Этот заказ уже оплачен');

$payment_method = $fivecms->payment->get_payment_method($order->payment_method_id);
$payment_settings = $fivecms->payment->get_payment_settings($payment_method->id);

$data = "mdOrder;{$mdOrder};operation;{$operation};orderNumber;{$orderNumber};status;{$status};";
$hmac = hash_hmac('sha256', $data, $payment_settings['key_sber']);

if ($checksum != strtoupper($hmac)) c_log('bad sign');

// Проверка на удачную оплату
if ($operation != 'deposited') c_log('Оплата не удалась');
// Проверка на завершение оплаты
$sberbank->set_order($order_id);
$order_status = $sberbank->get_order_status_extended($mdOrder);
if (!$order_status) c_log('Банк не отдал статус заказа');
if ($order_status->actionCode != 0) c_log("{$order_status->actionCode} {$order_status->actionCodeDescription}");

// Оплата прошла - закрываем ордер

// Проверка наличия товара
$purchases = $fivecms->orders->get_purchases(['order_id' => (int)$order->id]);
foreach($purchases as $purchase) {
    $variant = $fivecms->variants->get_variant((int)$purchase->variant_id);
    if(empty($variant) || (!$variant->infinity && $variant->stock < $purchase->amount)) {
        c_log("Нехватка товара $purchase->product_name $purchase->variant_name");
    }
}

// Ставим статус оплачен и начисляем баллы
$fivecms->orders->set_pay((int)$order->id);

// Спишем товары
$fivecms->orders->close((int)$order->id);

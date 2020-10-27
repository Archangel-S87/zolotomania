<?php

if (!function_exists('print_file')) {
    function print_file($data)
    {
        $file_data = '';

        for ($i = 0; $i < 40; $i++) {
            if ($i == 21) {
                $file_data .= date('d-m-Y H:i:s');
            }
            $file_data .= '-';
        }

        $file_data .= PHP_EOL;

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $file_data .= $key . '=' . $value . PHP_EOL;
            }
        } else {
            $file_data .= $data . PHP_EOL;
        }
        return file_put_contents(__DIR__ . '/callback.log', $file_data, FILE_APPEND);
    }
}

// https://dev.xn----8sbtgmhidba7b6k.xn--p1ai/payment/Sberbank/callback.php

$er = __DIR__;
$ff = 'http://zolotomania.loc/payment/Sberbank/callback.php?id=39&orderId=62ef71a3-0791-7703-b598-fc5f5e40ae9a&lang=ru';


print_file($_GET);

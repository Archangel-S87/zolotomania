<?php

/**
 * SMS рассылка сервсом Stream Telecom
 * https://stream-telecom.ru
 */

class StreamTelecom extends Fivecms
{
    const LOGIN = '79065734534';
    const PASS = '9e9yd2UGu9';
    const SOURCE_ADDRESS = 'ZolotoMania';

    const API = 'http://gateway.api.sc/get';

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

        $text = 'Ваш код ' . $code;

        //$this->send_sms_message($user->phone, $text);
    }

    public function check_sms_send($phone, $user_id)
    {
        $this->db->query("SELECT is_activate FROM __users_confirm_sms WHERE phone=? AND user_id=?", $phone, (int)$user_id);
        return $this->db->result('is_activate');
    }

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

    public function send_sms_message($phone, $message)
    {
        $url = self::API . '?user=' . self::LOGIN . '&pwd=' . self::PASS . '&sadr=' . self::SOURCE_ADDRESS . '&dadr=' . $phone . '&text=' . $message;
        file_get_contents($url);
    }
}

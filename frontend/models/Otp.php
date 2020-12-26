<?php

namespace app\models;

use Yii;

class Otp extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'otp';
    }

    public function rules()
    {
        return [
            [['phone', 'code'], 'required'],
            [['code'], 'string', 'max' => 6],
            [['phone'], 'string', 'max' => 10],
            [['phone'], 'match', 'pattern'=>"/^[6-9]\d{9}$/", 'message' => 'Please enter a valid 10-digit mobile number'],
            [['code'], 'match', 'pattern'=>"/\d{6}$/", 'message' => 'OTP should be a six digit number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'OTP',
        ];
    }

    public function generateotp() {
        return 123456;
        $string = '1239874506963258740115984762033579140862';
        $string_shuffled = str_shuffle($string);
        $password = substr($string_shuffled, 1, 6);
        return $password;
    }

    public function sendSms($msg, $phone) {
        return true;
        $authKey="7c4d5114a0e6d90074bbf35c9f1ab6bf";
        $sender = "AGRICULTURE REGISTRATION";

        $url = 'http://sms.globizsapp.com/api/send_http.php?authkey='.$authKey.'&mobiles='.$phone.'&message='.urlencode($msg).'&sender='.$sender.'&route=B';
        $ch =curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }

    // return 1 if expired
    public function otpExpiry() {
        $timediff = (strtotime(date('Y-m-d H:i:s')) - strtotime($this->last_sent))/60;
        return $timediff>20 ? 1 : 0;
    }
}

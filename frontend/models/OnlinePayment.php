<?php

namespace app\models;

use Yii;

class OnlinePayment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'online_payment';
    }

    public function rules()
    {
        return [
            [['registration_id', 'razorpay_order_id', 'amount', 'type'], 'required'],
            [['registration_id'], 'integer'],
            [['amount'], 'number'],
            [['created_date', 'updated_date'], 'safe'],
            [['razorpay_order_id', 'razorpay_payment_id', 'razorpay_signature'], 'string', 'max' => 255],
            [['registration_id'], 'exist', 'skipOnError' => true, 'targetClass' => Registration::className(), 'targetAttribute' => ['registration_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'registration_id' => 'Registration ID',
            'razorpay_order_id' => 'Razorpay Order ID',
            'razorpay_payment_id' => 'Razorpay Payment ID',
            'razorpay_signature' => 'Razorpay Signature',
            'amount' => 'Amount',
        ];
    }

    public function getRegistration()
    {
        return $this->hasOne(Registration::className(), ['id' => 'registration_id']);
    }
}

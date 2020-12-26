<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $confirmNewPassword;
 
    public function rules()
    {
        return [
            [['newPassword','confirmNewPassword', 'oldPassword'], 'required', 'message' => ''],
            [['newPassword','confirmNewPassword'], 'string', 'min' => 6],
            ['confirmNewPassword', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }
 
    public function attributeLabels()
    {
        return [
            'oldPassword' => 'Current Password',
            'newPassword' => 'New Password',
            'confirmNewPassword' => 'Repeat New Password',
        ];
    }
}

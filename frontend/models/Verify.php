<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

class Verify extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'registrations';
    }

    public function rules()
    {
        return [
            [['examination_board_1', 'x_roll_no'], 'required'],
            [['defect_reject_reason','application_status'],'safe'],
            [['x_roll_no'], 'string', 'max' => 12],
            [['x_roll_no'], 'customUnique'],
        ];
    }

    public function customUnique($attribute, $params)
    {
        if(Verify::find()->where(['examination_board_1'=>$this->examination_board_1,'x_roll_no'=>$this->x_roll_no,'status'=>'ACTIVE'])->exists()) {
            $this->addError($attribute, 'This '.strtoupper($attribute).' has already registered.');
        }
    }

    public function attributeLabels()
    {
        return [
            'examination_board_1' => 'Class X Examination Board',
            'x_roll_no' => 'Class X Roll No.',
        ];
    }

    // public function upload($attr) {
    //     if($this->$attr = UploadedFile::getInstance($this, $attr)) {
    //         $filename = 'uploads/'.$this->aadhaar.'_'.Yii::$app->security->generateRandomString(8)."_".strtotime(date('Y-m-d')).'.'.$this->$attr->extension;
    //         $this->$attr->saveAs($filename);
    //         $this->$attr = $filename;
    //         return true;
    //     }
    //     return false;
    // }

    // keep this. User in student login.
    // public function getTrade()
    // {
    //     return $this->hasOne(Trade::className(), ['id' => 'trade_allotted']);
    // }
}

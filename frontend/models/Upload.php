<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

class Upload extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'registrations';
    }

    public function rules()
    {
        return [
          [['marksheet_1','marksheet_2','certificate_1','certificate_2','migration_transfer','obc_sc_st_file','affidavit','other_course_certificate'],'safe'],
          [['photo'], 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg', 'minWidth'=>200, 'minHeight'=>250, 'maxSize' => 512000, 'tooBig' => 'Alert! Maximum file size allowed is 500KB'],
          [['marksheet_1','marksheet_2','certificate_1','certificate_2','migration_transfer','obc_sc_st_file','affidavit','other_course_certificate'], 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg', 'minWidth'=>500, 'minHeight'=>500, 'maxSize' => 512000, 'tooBig' => 'Alert! Maximum file size allowed is 500KB'],

        ];
    }
    public function attributeLabels()
    {
        return [
              'photo' => "Upload Candidate's Photo",
              'migration_transfer'=>'Upload Transfer Certificate',
              'obc_sc_st_file'=>'Upload Category Certificate',
              'marksheet_1'=>'Upload marksheet',
              'marksheet_2'=>'Upload marksheet',
              'certificate_1'=>'Upload Certificate',
              'certificate_2'=>'Upload Certificate',
              'other_course_certificate'=>'Course Certificate',
              'quota_certificate'=>'Upload Certificate'];
    }

    public function uploads($attr) {
        if($this->$attr = UploadedFile::getInstance($this, $attr)) {
            $filename = 'uploads/'.$this->x_roll_no.'_'.Yii::$app->security->generateRandomString(8)."_".strtotime(date('Y-m-d')).'.'.$this->$attr->extension;
            $this->$attr->saveAs($filename);
            $this->$attr = $filename;
            return true;
        }
        return false;
    }

}

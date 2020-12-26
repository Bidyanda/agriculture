<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property int $qualification
 * @property string $training_course
 * @property string $training_course_duration
 * @property string $certificate_awarded
 * @property string $photo
 * @property string $signature
 * @property string $created_date
 * @property int $created_by
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public $photos,$signatures;
    public function rules()
    {
        return [
            [['name', 'email', 'address', 'name_of_concern','qualification', 'training_course', 'training_course_duration', 'photo', 'signature', 'created_by','district'], 'required'],
            [['qualification','address'], 'string'],
            [['name', 'address','qualification','training_course','district','name_of_concern'], 'match', 'pattern'=>"/^[a-zA-Z\.+0-9,'\(\)\-#_ \/]*$/", 'message'=>'Error! {attribute} cannot contain invalid characters'],
            [['training_course_duration'],'match', 'pattern'=>"/^[1-9]$/", 'message' => 'Please enter a valid 10-digit mobile number'],
            [['certificate_awarded','photos','signatures'],'safe'],
            [['created_by'], 'integer'],
            ['email', 'email', 'message'=>'Please enter a valid email address'],
            [['name', 'email', 'training_course', 'training_course_duration','qualification'], 'string', 'max' => 255],
            [['photo','certificate_awarded'], 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg', 'minWidth'=>200, 'minHeight'=>250, 'maxSize' => 512000, 'tooBig' => 'Alert! Maximum file size allowed is 500KB'],
            [['signature'], 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg', 'minWidth'=>300, 'minHeight'=>100, 'maxSize' => 512000, 'tooBig' => 'Alert! Maximum file size allowed is 500KB'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'address' => 'Address',
            'qualification' => 'Qualification',
            'training_course' => 'Training Course',
            'training_course_duration' => 'Training Course Duration',
            'certificate_awarded' => 'Certificate Awarded',
            'photo' => 'Photo',
            'signature' => 'Signature',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'photos'=>'Photo',
            'signature' =>'Signature',
            'name_of_concern'=>'Name of Concern',
        ];
    }

    public function upload($attr) {
        if($this->$attr = UploadedFile::getInstance($this, $attr)) {
            $filename = 'uploads/'.Yii::$app->security->generateRandomString(8)."_".strtotime(date('Y-m-d')).'.'.$this->$attr->extension;
            $this->$attr->saveAs($filename);
            $filename =  '/'.$filename;
            $this->$attr = $filename;
            return true;
        }
        return false;
    }
}

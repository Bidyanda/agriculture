<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Insecticide;
use frontend\models\Profile;
use frontend\models\PpChemical;
use frontend\models\Fertilizer;
use frontend\models\FertilizerItem;
use app\models\Upload;
use app\models\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ApplicationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    public function actionIndex()
    {
      $models = PpChemical::find()->select('is_renew,payment_status,status,application_fee_amount,district_officer_verified,directorate_officer_verified,id,application_date')->where(['user_id'=>Yii::$app->user->id])->orderby('id')->all();
      return $this->render('index',['models'=>$models]);
    }

    public function actionProfile()
    {
      $is_update = 0;
      $model = Profile::find()->where(['created_by'=>Yii::$app->user->identity->id])->one();
      if(!$model)
        $model = new Profile();
      else {
        $is_update = 1;
        $certificate_awarded = $model->certificate_awarded;
        $photo = $model->photo;
        $signature = $model->signature;
      }

      if($model->load(Yii::$app->request->post()))
      {
        if(!$is_update){
          if(!$model->upload('photo') || !$model->upload('signature')) {
              Yii::$app->session->setFlash('danger', 'Failed to save either photo or signature. Please try again.');
              return $this->redirect(['profile']);
          }
        }else{
          if($model->upload('photos')){
            $model->photo = $model->photos;
          }

          if($model->upload('signatures')) {
            $model->signature = $model->signatures;
          }
        }
        $model->upload('certificate_awarded');
        if(empty($model->certificate_awarded)){
          $model->certificate_awarded = $certificate_awarded;
        }
        if(empty($model->photo)){
          $model->photo = $photo;
        }
        if(empty($model->signature)){
          $model->signature = $signature;
        }

        $model->created_by = Yii::$app->user->identity->id;
        if($model->save()){
          Yii::$app->session->setFlash('success', 'Profile created successfully....');
          return $this->redirect(['profile']);
        }
      }
      return $this->render('/profile/create',['model'=>$model,'is_update'=>$is_update]);
    }

    public function actionInsecticide($is_renew='')
    {
      $model = new PpChemical();
      $flag = 0;
      $modelsInsecticide = [new Insecticide()];
      if(!empty($is_renew)){
        $model->is_renew = $is_renew;
      }
      if($model->load(Yii::$app->request->post())){
        $modelsInsecticide = Model::createMultiple(Insecticide::classname());
        Model::loadMultiple($modelsInsecticide, Yii::$app->request->post());
        if($model->approval_of_technical_expertise == 'yes'){
          $model->if_yes_approved_date = date('Y-m-d',strtotime($model->if_yes_approved_date));
          $model->if_yes_validity = date('Y-m-d',strtotime($model->if_yes_validity));
        }
        if(!$model->upload('details_of_safety_equipment_antidotes')) {
            Yii::$app->session->setFlash('danger', 'Failed to save either photo or signature. Please try again.');
            return $this->redirect(['profile']);
        }

        $model->created_by = Yii::$app->user->identity->id;
        $model->user_id = Yii::$app->user->identity->id;
        $model->application_date = date('Y-m-d');
        $transaction = \Yii::$app->db->beginTransaction();
              try {
                      if($model->save(false)){
                        foreach ($modelsInsecticide as $modelInsecticide) {
                          $modelInsecticide->pp_id = $model->id;
                          $modelInsecticide->principal_certificate_date_of_issue = date('Y-m-d',strtotime($modelInsecticide->principal_certificate_date_of_issue));
                          $modelInsecticide->principal_certificate_validity = date('Y-m-d',strtotime($modelInsecticide->principal_certificate_validity));
                          if(!$flag = $modelInsecticide->save())
                            break;
                        }
                      }
                      if ($flag) {
                          $transaction->commit();
                          Yii::$app->session->setFlash('success', 'Form submitted successfully....');
                          return $this->redirect(['index']);
                      }else {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('danger', 'Form submitted failed.');
                        return $this->redirect(Yii::$app->request->referrer);
                      }
                  } catch (Exception $e) {
                      $transaction->rollBack();
                  }
      }
      return $this->render('/pp-chemical/_form',[
        'model'=>$model,
        'modelsInsecticide'=>[new Insecticide()],
      ]);
    }

    public function actionFertilizer()
    {
      $model = new Fertilizer();
      $flag = 0;
      $modelsFertilizer = [new FertilizerItem()];
      if(!empty($is_renew)){
        $model->is_renew = $is_renew;
      }
      if($model->load(Yii::$app->request->post())){
        $modelsFertilizer = Model::createMultiple(FertilizerItem::classname());
        Model::loadMultiple($modelsFertilizer, Yii::$app->request->post());

        if(!$model->upload('details_of_safety_equipment_antidotes')) {

        }

        $model->created_by = Yii::$app->user->identity->id;
        $model->user_id = Yii::$app->user->identity->id;
        $model->application_date = date('Y-m-d');
        $transaction = \Yii::$app->db->beginTransaction();
              try {
                      if($model->save(false)){
                        foreach ($modelsFertilizer as $modelInsecticide) {

                          if(!$flag = $modelInsecticide->save())
                            break;
                        }
                      }
                      if ($flag) {
                          $transaction->commit();
                          Yii::$app->session->setFlash('success', 'Form submitted successfully....');
                          return $this->redirect(['index']);
                      }else {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('danger', 'Form submitted failed.');
                        return $this->redirect(Yii::$app->request->referrer);
                      }
                  } catch (Exception $e) {
                      $transaction->rollBack();
                  }
      }
      return $this->render('/fertilizer/_form',[
        'model'=>$model,
        'modelsInsecticide'=>[new Insecticide()],
      ]);
    }
}

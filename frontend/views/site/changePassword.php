<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body">
        <div class="pagetitle"><?= $this->title ?></div>

        <div class="row">
        	<div class="col-md-4">
                <?php $form = ActiveForm::begin(); ?>
             
             		<?= $form->field($model, 'oldPassword')->passwordInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'newPassword')->passwordInput() ?>
                    <?= $form->field($model, 'confirmNewPassword')->passwordInput() ?>
             
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

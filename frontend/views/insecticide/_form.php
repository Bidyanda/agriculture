<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Insecticide */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insecticide-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pp_id')->textInput() ?>

    <?= $form->field($model, 'sl_no')->textInput() ?>

    <?= $form->field($model, 'particular_of_insecticide')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name_of_manufacturer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_certificate_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_certificate_date_of_issue')->textInput() ?>

    <?= $form->field($model, 'principal_certificate_validity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

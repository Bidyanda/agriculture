<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FertilizerItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fertilizer-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'f_id')->textInput() ?>

    <?= $form->field($model, 'fertilizer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'whether_cert_form_o_attach')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

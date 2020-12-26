<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\InsecticideSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insecticide-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pp_id') ?>

    <?= $form->field($model, 'sl_no') ?>

    <?= $form->field($model, 'particular_of_insecticide') ?>

    <?= $form->field($model, 'name_of_the manufacturer') ?>

    <?php // echo $form->field($model, 'registration_no') ?>

    <?php // echo $form->field($model, 'principal_certificate_no') ?>

    <?php // echo $form->field($model, 'principal_certificate_date_of_issue') ?>

    <?php // echo $form->field($model, 'principal_certificate_validity') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

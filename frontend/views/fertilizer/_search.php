<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FertilizerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fertilizer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'address_of_sale') ?>

    <?= $form->field($model, 'address_of_storage') ?>

    <?= $form->field($model, 'manufacture') ?>

    <?php // echo $form->field($model, 'importer') ?>

    <?php // echo $form->field($model, 'pool_handling_agency') ?>

    <?php // echo $form->field($model, 'wholesale_dealer') ?>

    <?php // echo $form->field($model, 'retail_dealer') ?>

    <?php // echo $form->field($model, 'application_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'record_status') ?>

    <?php // echo $form->field($model, 'district_officer_verified') ?>

    <?php // echo $form->field($model, 'directorate_officer_verified') ?>

    <?php // echo $form->field($model, 'payment_status') ?>

    <?php // echo $form->field($model, 'application_fee_date') ?>

    <?php // echo $form->field($model, 'application_fee_amount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

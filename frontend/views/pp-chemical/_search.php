<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PpChemicalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pp-chemical-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'address_of_registered') ?>

    <?= $form->field($model, 'address_of_premises') ?>

    <?= $form->field($model, 'approval_of_technical_expertise') ?>

    <?= $form->field($model, 'if_yes_ref_no') ?>

    <?php // echo $form->field($model, 'if_yes_date_validity') ?>

    <?php // echo $form->field($model, 'name_of_restricted_insecticides') ?>

    <?php // echo $form->field($model, 'name_of_resp_tech_persion') ?>

    <?php // echo $form->field($model, 'restricted_insecticide_possession_date') ?>

    <?php // echo $form->field($model, 'if_yes_particulars_respective_quantity_possession') ?>

    <?php // echo $form->field($model, 'details_of_safety_equipment_antidotes') ?>

    <?php // echo $form->field($model, 'insecticide_store_address') ?>

    <?php // echo $form->field($model, 'insecticide_store_land') ?>

    <?php // echo $form->field($model, 'insecticide_store_pin_code') ?>

    <?php // echo $form->field($model, 'insecticide_store_disctrict') ?>

    <?php // echo $form->field($model, 'insecticide_stored_or_stocked') ?>

    <?php // echo $form->field($model, 'sold_exhibited_for_sale_issued') ?>

    <?php // echo $form->field($model, 'above_premises_residential_area') ?>

    <?php // echo $form->field($model, 'above_premises_food_articles_stored') ?>

    <?php // echo $form->field($model, 'if_issued_of_applicant_licence') ?>

    <?php // echo $form->field($model, 'if_renewal_licence_no') ?>

    <?php // echo $form->field($model, 'if_renewal_date_of_grant') ?>

    <?php // echo $form->field($model, 'particular_application_fee') ?>

    <?php // echo $form->field($model, 'application_challan_or_draft_pay_order') ?>

    <?php // echo $form->field($model, 'application_fee_date') ?>

    <?php // echo $form->field($model, 'application_fee_amount') ?>

    <?php // echo $form->field($model, 'sub_treasury_in_treasury_challan') ?>

    <?php // echo $form->field($model, 'any_other_info') ?>

    <?php // echo $form->field($model, 'application_date') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'record_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PpChemical */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pp Chemicals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pp-chemical-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'address_of_registered:ntext',
            'address_of_premises:ntext',
            'approval_of_technical_expertise',
            'if_yes_ref_no',
            'if_yes_date_validity',
            'name_of_restricted_insecticides',
            'name_of_resp_tech_persion',
            'restricted_insecticide_possession_date',
            'if_yes_particulars_respective_quantity_possession',
            'details_of_safety_equipment_antidotes',
            'insecticide_store_address:ntext',
            'insecticide_store_land',
            'insecticide_store_pin_code',
            'insecticide_store_disctrict',
            'insecticide_stored_or_stocked',
            'sold_exhibited_for_sale_issued',
            'above_premises_residential_area',
            'above_premises_food_articles_stored',
            'if_issued_of_applicant_licence',
            'if_renewal_licence_no',
            'if_renewal_date_of_grant',
            'particular_application_fee',
            'application_challan_or_draft_pay_order',
            'application_fee_date',
            'application_fee_amount',
            'sub_treasury_in_treasury_challan',
            'any_other_info:ntext',
            'application_date',
            'created_date',
            'created_by',
            'record_status',
        ],
    ]) ?>

</div>

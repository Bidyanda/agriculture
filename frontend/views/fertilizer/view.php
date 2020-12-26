<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Fertilizer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fertilizers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fertilizer-view">

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
            'user_id',
            'address_of_sale',
            'address_of_storage',
            'manufacture',
            'importer',
            'pool_handling_agency',
            'wholesale_dealer',
            'retail_dealer',
            'application_date',
            'status',
            'created_date',
            'created_by',
            'record_status',
            'district_officer_verified',
            'directorate_officer_verified',
            'payment_status',
            'application_fee_date',
            'application_fee_amount',
        ],
    ]) ?>

</div>

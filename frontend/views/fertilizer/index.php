<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FertilizerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fertilizers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fertilizer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fertilizer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'address_of_sale',
            'address_of_storage',
            'manufacture',
            //'importer',
            //'pool_handling_agency',
            //'wholesale_dealer',
            //'retail_dealer',
            //'application_date',
            //'status',
            //'created_date',
            //'created_by',
            //'record_status',
            //'district_officer_verified',
            //'directorate_officer_verified',
            //'payment_status',
            //'application_fee_date',
            //'application_fee_amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

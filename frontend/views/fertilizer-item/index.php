<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FertilizerItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fertilizer Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fertilizer-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fertilizer Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'f_id',
            'fertilizer_name',
            'whether_cert_form_o_attach',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

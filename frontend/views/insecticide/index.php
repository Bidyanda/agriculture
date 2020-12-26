<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\InsecticideSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Insecticides';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insecticide-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Insecticide', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pp_id',
            'sl_no',
            'particular_of_insecticide:ntext',
            'name_of_manufacturer',
            //'registration_no',
            //'principal_certificate_no',
            //'principal_certificate_date_of_issue',
            //'principal_certificate_validity',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

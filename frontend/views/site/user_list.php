<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Courses;
/* @var $this yii\web\View */
/* @var $searchModel app\models\StateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$course = ArrayHelper::map(Courses::find()->all(),'id','name');
$this->title = 'User List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add User', ['/site/add-user'], ['class'=>'openModal btn btn-primary sm', 'size'=>'md','header'=>'Add User']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'username',
            'email',
            [
              'attribute'=>'course_id',
              'label'=>'Course',
              'value'=>function($model)use ($course){
                return $course[$model->course_id];
              },
            ],
            [
              'attribute'=>'status',
              'value'=>function($model){
                return $model->status == '10'?'Active':'Inactive';
              },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title'=>'Delte User','dat-method'=>'post']);
                    },
                ]
            ],
        ],
    ]); ?>


</div>

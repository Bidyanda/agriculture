<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Insecticide */

$this->title = 'Update Insecticide: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Insecticides', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="insecticide-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

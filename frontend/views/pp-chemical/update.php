<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PpChemical */

$this->title = 'Update Pp Chemical: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pp Chemicals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pp-chemical-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

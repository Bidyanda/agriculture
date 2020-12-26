<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FertilizerItem */

$this->title = 'Create Fertilizer Item';
$this->params['breadcrumbs'][] = ['label' => 'Fertilizer Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fertilizer-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Fertilizer */

$this->title = 'Create Fertilizer';
$this->params['breadcrumbs'][] = ['label' => 'Fertilizers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fertilizer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

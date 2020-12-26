<?php

use yii\helpers\Html;
use frontend\models\insecticide;
/* @var $this yii\web\View */
/* @var $model frontend\models\Insecticide */

$this->title = 'Create Insecticide';
$this->params['breadcrumbs'][] = ['label' => 'Insecticides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insecticide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsInsecticide'=> $modelsInsecticide,
    ]) ?>

</div>

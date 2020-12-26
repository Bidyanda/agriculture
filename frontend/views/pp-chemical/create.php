<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PpChemical */

// $this->title = 'Create Pp Chemical';
// $this->params['breadcrumbs'][] = ['label' => 'Pp Chemicals', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="pp-chemical-create">

    <!-- <h1><?//= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

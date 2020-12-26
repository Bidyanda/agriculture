<?php

use yii\helpers\Html;

$this->title = 'Update Setting';
?>
<div class="setting-update">

    <div class="pagetitle"><?= Html::encode($this->title) ?></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$webroot = Yii::getAlias('@web');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Official Website of Department of Agriculture | Government of Manipur - <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <img class="img-responsive" src="<?= $webroot ?>/images/logo.png">
            </div>
        </div>

        <?php
        NavBar::begin([
            'options' => [
                'class' => 'navbar-default',
            ],
            'innerContainerOptions' => [
                'class' => 'toolbar'       // to remove container class
            ]
        ]);
        if (Yii::$app->user->isGuest) {
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index'], 'active' => in_array($this->context->route, ['site/index'])],
                ['label' => 'Registration', 'url' => ['/site/signup']],
                ['label' => 'Login', 'url' => ['/site/login']],
                ['label' => 'How to apply', 'url' => ['/site/help']],
            ];
        }else if(Yii::$app->user->can('admin')){
          $menuItems = [
              ['label' => 'Home', 'url' => ['/site/index'], 'active' => in_array($this->context->route, ['site/index'])],
              ['label'=>'Application', 'url'=>'#!', 'items' => [
                  ['label'=>'Insecticide', 'url'=>['/insecticide/index']],
                  ['label' => 'Fertilizer', 'url' => ['/site/help']]
              ]],
              ['label'=>'My Account', 'url'=>'#!', 'items' => [
                  ['label'=>'Change Password', 'url'=>['/site/change-password']],
                  ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
              ]],
              ['label' => 'How to apply', 'url' => ['/site/help']],
          ];
        }else {
          $menuItems = [
              ['label' => 'Home', 'url' => ['/site/index'], 'active' => in_array($this->context->route, ['site/index'])],
              ['label'=>'Application Apply', 'url'=>'#!', 'items' => [
                  ['label'=>'Insecticide', 'url'=>['/application/insecticide']],
                  ['label' => 'Fertilizer', 'url' => ['/application/fertilizer']]
              ], 'active' => in_array($this->context->route, ['application/insecticide','application/fertilizer'])],
              ['label'=>'My Account', 'url'=>'#!', 'items' => [
                  ['label'=>'Profile', 'url'=>['/application/profile']],
                  ['label'=>'Change Password', 'url'=>['/site/change-password']],
                  ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
              ],'active' => in_array($this->context->route, ['application/profile'])],
              ['label' => 'How to apply', 'url' => ['/site/help']],
          ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

        <div class="content">
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => 'Home',
                    'url' => '/site/index',
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="clearfix"></div>        <!-- Need this! -->
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>

    </div>
</div>
<div id="snackbar"></div>

<?= $this->render('modal.php') ?>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">&copy; 2020 Department of Agriculture</div>
            <div class="col-md-4 privacy">Privacy Policy</div>
            <div class="col-md-4 globizsrow"><a class="globizs" href="https://globizs.com" target="_blank">Powered by Globizs</a></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

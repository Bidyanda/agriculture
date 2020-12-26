<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/form.css',
        'css/site.css',
        'css/styles.css',
        'css/theme.css'
    ];
    public $js = [
        'js/main.js',
        'https://use.fontawesome.com/bc707fd440.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

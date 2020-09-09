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
        'css/v1.0.0/bootstrap.min.css',
        'css/v1.0.0/style.css',
       // 'css/site.css',
    ];
    public $js = [
        'js/v1.0.0/jquery.slim.min.js',
        'js/v1.0.0/popper.min.js',
        'js/v1.0.0/bootstrap.min.js',
        'js/v1.0.0/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

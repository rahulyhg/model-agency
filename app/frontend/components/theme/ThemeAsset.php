<?php

namespace frontend\components\theme;

use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{
  public $sourcePath = '@frontend/components/theme/assets/dist/assets';

  public $css = [
    'lib/jquery.fancybox/jquery.fancybox.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',
    'lib/jquery.scrollbar/jquery.scrollbar.css',

    'css/main.css',
  ];
  public $js = [
    'lib/autosize.min.js',
    'lib/jquery.fancybox/jquery.fancybox.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js',
    'lib/jquery.scrollbar/jquery.scrollbar.min.js',
    'lib/select2-searchInputPlaceholder.js',

    'js/main.js'
  ];

  public $depends = [
    'yii\bootstrap\BootstrapPluginAsset',
    'yii\web\JqueryAsset',
  ];

  public $publishOptions = [
    'forceCopy' => true
  ];
}
<?php

namespace frontend\components\theme;

use yii\web\AssetBundle;

class AdvThemeAsset extends AssetBundle
{
  public $sourcePath = '@frontend/components/theme/assets';

  public $css = [
    'icon/pe-icon-7/css/pe-icon-7-stroke.css',
    'https://use.fontawesome.com/releases/v5.5.0/css/all.css',
    'lib/normalize.css',
    '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
    'lib/jquery.fancybox/jquery.fancybox.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',
    'lib/jquery.scrollbar/jquery.scrollbar.css',

    'css/main.css',
    'css/custom.css'
  ];
  public $js = [
    //'lib/jquery-3.3.1.min.js',
    'lib/jquery.maskedinput.min.js',
    'lib/jquery.fancybox/jquery.fancybox.min.js',
    '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js',
    'lib/jquery.scrollbar/jquery.scrollbar.min.js',
    'lib/select2-searchInputPlaceholder.js',
    'lib/autosize.min.js',

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
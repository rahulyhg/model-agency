<?php

namespace frontend\components\theme;

use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{
  public $sourcePath = '@frontend/components/theme/assets/dist/assets';

  public $css = [
    'css/main.css'
  ];
  public $js = [
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
<?php

namespace backend\assets;

use yii\web\AssetBundle;

class BoardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/board.css',
    ];
}

<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $depends = [
        YiiAsset::class
    ];
}

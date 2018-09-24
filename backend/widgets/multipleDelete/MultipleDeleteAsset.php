<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.12.2016
 * Time: 12:45
 */

namespace backend\widgets\multipleDelete;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class MultipleDeleteAsset extends AssetBundle
{
    public $sourcePath = '@backend/widgets/multipleDelete/assets';

    public $js = [
        'multiple-delete.js',
    ];

    public $depends = [
      JqueryAsset::class,
    ];
}
<?php

namespace backend\widgets\crudButtons;


use backend\components\metronic\CoreAsset;
use yii\web\AssetBundle;

class CrudButtonsAsset extends AssetBundle
{
    public $sourcePath = '@backend/widgets/crudButtons/assets';

    public $js = [
        'link-sweetalert.js',
    ];

    public $depends = [
    ];

    public $publishOptions = [
    	'forceCopy' => true
    ];
}

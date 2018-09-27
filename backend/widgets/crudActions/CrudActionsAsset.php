<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.12.2016
 * Time: 12:45
 */

namespace backend\widgets\crudActions;


use common\components\metronic\SweetAlertAsset;
use yii\web\AssetBundle;

class CrudActionsAsset extends AssetBundle
{
    public $sourcePath = '@backend/widgets/crudActions/assets';

    public $js = [
        'link-sweetalert.js',
    ];

    public $depends = [
        SweetAlertAsset::class,
    ];
}

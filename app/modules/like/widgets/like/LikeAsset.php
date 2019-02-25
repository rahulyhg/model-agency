<?php
namespace modules\like\widgets\like;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class LikeAsset extends AssetBundle
{
  public $sourcePath = '@modules/like/widgets/like/assets';

  public $js = [
    'js/like.js'
  ];

  public $css = [];

  public $depends = [
    JqueryAsset::class
  ];

  public $publishOptions = [
    'forceCopy' => true
  ];
}
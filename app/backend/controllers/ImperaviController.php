<?php

namespace backend\controllers;

use backend\models\SalesFunnel;
use backend\models\SalesFunnelColumn;
use Yii;
use backend\models\Imperavi;
use backend\models\ImperaviSearch;
use backend\lib\Controller;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImperaviController implements the CRUD actions for Imperavi model.
 */
class ImperaviController extends Controller
{
  public function actions()
  {
    return [
      'images-get' => [
        'class' => \vova07\imperavi\actions\GetImagesAction::class,
        'url' =>  Yii::getAlias('@web/redactor-storage'), // Directory URL address, where files are stored.
        'path' => Yii::getAlias('@webroot/redactor-storage'), // Or absolute path to directory where files are stored.
        'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']], // These options are by default.
      ],
      'image-upload' => [
        'class' => \vova07\imperavi\actions\UploadFileAction::class,
        'url' => Yii::getAlias('@web/redactor-storage'), // Directory URL address, where files are stored.
        'path' => Yii::getAlias('@webroot/redactor-storage'), // Or absolute path to directory where files are stored.
      ],
      'file-delete' => [
        'class' => \vova07\imperavi\actions\DeleteFileAction::class,
        'url' => Yii::getAlias('@web/redactor-storage'), // Directory URL address, where files are stored.
        'path' => Yii::getAlias('@webroot/redactor-storage'), // Or absolute path to directory where files are stored.
      ],
    ];
  }
}

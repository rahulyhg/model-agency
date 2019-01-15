<?php
/**
 * Created by PhpStorm.
 * User: Oleks
 * Date: 14.01.2019
 * Time: 13:51
 */

namespace modules\mod\backend\controllers;


use modules\mod\common\models\Mod;
use modules\mod\common\services\ModService;
use Yii;
use common\lib\Controller;

class ModImageController extends Controller
{
  public function actionDeleteImage(int $modId)
  {
    $modObject = Mod::findOne(['id' => $modId]);

    $fileId = Yii::$app->request->post('key');
    if(Yii::$app->filestorage->removeFile($fileId)){
      ModService::resetImagesOrder($modObject, false, $fileId);
      return true;
    }

    return false;
  }
}
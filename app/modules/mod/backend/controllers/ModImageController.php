<?php
namespace modules\mod\backend\controllers;

use modules\mod\common\models\Mod;
use modules\mod\common\models\ModImage;
use Yii;
use common\lib\Controller;

class ModImageController extends Controller
{
  public function actionDeleteImage(int $modId)
  {
    $modObject = Mod::findOne(['id' => $modId]);
    $fileId = Yii::$app->request->post('key');
    $modImage = ModImage::findOne(['image_id' => $fileId, 'entity_id' => $modObject->id]);
    if($modImage->delete()) {
      return true;
    }
    return false;
  }
}
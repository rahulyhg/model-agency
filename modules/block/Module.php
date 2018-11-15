<?php

namespace modules\block;

use modules\block\common\models\Block;
use Yii;

class Module extends \common\lib\Module
{
  public $controllerNamespace = 'app\modules\block\backend\controllers';
  
  /**
   * @param $key
   * @return null|string
   */
  public static function getBlock($key)
  {
    if($model = Block::findOne(['key' => $key])){
      return $model->content;
    }
    return null;
  }

  public static function registerTranslations()
  {
    Yii::$app->i18n->translations['modules/block/*'] = [
      'class' => 'yii\i18n\PhpMessageSource',
      'sourceLanguage' => 'en-US',
      'basePath' => '@modules/block/messages',
      'fileMap' => [
        'modules/block/attributeLabels' => 'attributeLabels.php',
      ]
    ];
  }

  public static function t($category, $message, $params = [], $language = null)
  {
    return Yii::t('modules/block/' . $category, $message, $params, $language);
  }
}
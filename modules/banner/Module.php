<?php

namespace modules\banner;

use modules\banner\common\models\Banner;
use Yii;

class Module extends \common\lib\Module
{
  public $controllerNamespace = 'app\modules\banner\backend\controllers';
  
  /**
   * @param $position
   * @return null|string
   */
  public static function getBanner($position)
  {
    if ($model = Banner::findOne(['position' => $position])) {
      return $model->text;
    }
    return null;
  }

  public static function registerTranslations()
  {
    Yii::$app->i18n->translations['modules/banner/*'] = [
      'class' => 'yii\i18n\PhpMessageSource',
      'sourceLanguage' => 'en-US',
      'basePath' => '@modules/banner/messages',
      'fileMap' => [
        'modules/banner/attributeLabels' => 'attributeLabels.php',
        'modules/banner/crud' => 'crud.php'
      ]
    ];
  }

  public static function t($category, $message, $params = [], $language = null)
  {
    return Yii::t('modules/banner/' . $category, $message, $params, $language);
  }
}
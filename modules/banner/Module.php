<?php

namespace modules\banner;

use modules\banner\common\models\Banner;
use Yii;

class Module extends \common\lib\Module
{
  public $controllerNamespace = 'app\modules\banner\backend\controllers';

  public function init()
  {
    parent::init();
    $this->registerTranslations();
  }
  
  /**
   * @param $position
   * @return null|string
   */
  public static function getBanner($position)
  {
    if ($model = Banner::findOne(['position' => $position])) {
      return $model->content;
    }
    return null;
  }

  public function registerTranslations()
  {
    Yii::$app->i18n->translations['modules/banner/*'] = [
      'class' => 'yii\i18n\PhpMessageSource',
      'sourceLanguage' => 'en-US',
      'basePath' => '@modules/banner/messages',
      'fileMap' => [
        'modules/banner/attributeLabels' => 'attributeLabels.php',
      ]
    ];
  }

  public static function t($category, $message, $params = [], $language = null)
  {
    return Yii::t('modules/banner/' . $category, $message, $params, $language);
  }
}
<?php

namespace modules\setting;

use modules\setting\common\models\Setting;
use ReflectionClass;
use Yii;

class Module extends \common\lib\Module
{
  public $app = 'backend';
  public $controllerNamespace = 'app\modules\setting\backend\controllers';

  public function init()
  {
    parent::init();
    $this->registerTranslations();
  }

  /**
   * Set setting value by section and key
   * @param $section
   * @param $key
   * @param $newValue
   * @return bool
   */
  public static function setSetting($section, $key, $newValue)
  {
    /**
     * @var $model Setting
     */
    $model = Setting::findOne(['section' => $section, 'key' => $key]);
    $model->value = $newValue;
    return $model->save();
  }

  /**
   * Get setting value by section and key
   * @param $section
   * @param $key
   * @return bool|string
   */
  public static function getSetting($section, $key)
  {
    if ($model = Setting::findOne(['section' => $section, 'key' => $key]))
      return $model->value;
    return false;
  }

  public function registerTranslations()
  {
    Yii::$app->i18n->translations['modules/setting/*'] = [
      'class' => 'yii\i18n\PhpMessageSource',
      'sourceLanguage' => 'en-US',
      'basePath' => '@modules/setting/messages',
      'fileMap' => [
        'modules/setting/attributeLabels' => 'attributeLabels.php',
      ]
    ];
  }

  public static function t($category, $message, $params = [], $language = null)
  {
    return Yii::t('modules/setting/' . $category, $message, $params, $language);
  }
}
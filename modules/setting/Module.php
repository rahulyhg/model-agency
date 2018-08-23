<?php
namespace modules\setting;

use modules\setting\common\models\Setting;
use ReflectionClass;

class Module extends \common\lib\Module
{
  public $app = 'backend';

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
}
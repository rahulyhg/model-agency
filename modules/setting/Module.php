<?php
namespace modules\setting;

use common\lib\SMModule;
use modules\setting\common\models\Setting;
use ReflectionClass;

class Module extends \yii\base\Module
{
  public $app = 'backend';

  public function init()
  {
    parent::init();
    $childClassInfo = new ReflectionClass($this);
    $dirPath = dirname($childClassInfo->getFileName());
    $dirName = basename($dirPath);
    if ($this->app == 'backend') {
      $this->viewPath = $dirPath . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'views';
      $this->controllerNamespace = 'modules\\' . $dirName . '\\backend\\controllers';
    }
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
}
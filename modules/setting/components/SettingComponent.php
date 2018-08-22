<?php
namespace modules\setting\components;
use modules\setting\Module;
use yii\base\Exception;

/**
 * Class SettingComponent
 * @package common\components\setting
 */
class SettingComponent extends \yii\base\Component
{
    /**
     * Name of main setting module class
     * @var string
     */
    public $settingModuleClass = Module::class;

    /**
     * Method name in setting module class for get setting
     * @var string
     */
    public $getSettingMethodName = 'getSetting';

    /**
     * Method name in setting module class for set setting
     * @var string
     */
    public $setSettingMethodName = 'setSetting';

    public function init()
    {
        parent::init();
        if( ! $this->settingModuleClass ) {
            throw new Exception('settingModuleClass is not defined for SettingComponent.');
        }
        if( ! class_exists($this->settingModuleClass) ) {
            throw new Exception("{$this->settingModuleClass} does not exist.");
        }
        if( ! method_exists($this->settingModuleClass, $this->getSettingMethodName) ) {
            throw new Exception("{$this->settingModuleClass} does not exist {$this->getSettingMethodName} method.");
        }
        if( ! method_exists($this->settingModuleClass, 'setSetting') ) {
            throw new Exception("{$this->settingModuleClass} does not exist {$this->setSettingMethodName} method.");
        }
    }

    /**
     * Get setting from setting module
     * @param $section
     * @param $key
     * @return mixed
     */
    public function get($section, $key)
    {
        $moduleObj = $this->settingModuleClass;
        $getMethodName = $this->getSettingMethodName;
        return $moduleObj::$getMethodName($section, $key);
    }

    /**
     * Set setting in setting module
     * @param $section
     * @param $key
     * @param $newValue
     * @return mixed
     */
    public function set($section, $key, $newValue)
    {
        $moduleObj = $this->settingModuleClass;
        $setMethodName = $this->setSettingMethodName;
        return $moduleObj::$setMethodName($section, $key, $newValue);
    }
}
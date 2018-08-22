<?php
namespace common\components\setting;
use common\components\setting\models\Setting;
use yii\base\Exception;

/**
 * Class SettingComponent
 * @package common\components\setting
 */
class SettingComponent extends \yii\base\Component
{
    public function init()
    {
    }

    /**
     * Get setting from setting module
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return Setting::findOne(['key' => $key]);
    }

    /**
     * Set setting in setting module
     * @param $key
     * @param $newValue
     * @return mixed
     */
    public function set($key, $newValue)
    {
    	$setting = Setting::findOne(['key' => $key]);
	    $setting->value = $newValue;
        return $setting->save();
    }
}
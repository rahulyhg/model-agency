<?php
namespace modules\banner\components;

use modules\banner\Module;
use yii\base\Exception;

/**
 * Class BlockComponent
 * @package common\components\block
 */
class BannerComponent extends \yii\base\Component
{
    /**
     * Name of main block module class
     * @var string
     */
    public $blockModuleClass = Module::class;

    /**
     * Method name in block module class for get block
     * @var string
     */
    public $getBlockMethodName = 'getBanner';

    public function init()
    {
        parent::init();
        if( ! $this->blockModuleClass ) {
            throw new Exception('blockModuleClass is not defined for BlockComponent.');
        }
        if( ! class_exists($this->blockModuleClass) ) {
            throw new Exception("{$this->blockModuleClass} does not exist.");
        }
        if( ! method_exists($this->blockModuleClass, $this->getBlockMethodName) ) {
            throw new Exception("{$this->blockModuleClass} does not exist {$this->getBlockMethodName} method.");
        }
    }

    /**
     * Get banner from banner module
     * @param $position
     * @return mixed
     */
    public function get($position)
    {
        $moduleObj = $this->blockModuleClass;
        $getMethodName = $this->getBlockMethodName;
        return $moduleObj::$getMethodName($position);
    }
}
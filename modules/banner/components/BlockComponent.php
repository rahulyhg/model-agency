<?php
namespace modules\block\components;
use modules\block\Module;
use yii\base\Exception;

/**
 * Class BlockComponent
 * @package common\components\block
 */
class BlockComponent extends \yii\base\Component
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
    public $getBlockMethodName = 'getBlock';

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
     * Get block from block module
     * @param $section
     * @param $key
     * @return mixed
     */
    public function get($section, $key)
    {
        $moduleObj = $this->blockModuleClass;
        $getMethodName = $this->getBlockMethodName;
        return $moduleObj::$getMethodName($section, $key);
    }
}
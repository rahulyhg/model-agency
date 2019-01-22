<?php

namespace backend\modules\document\traits;

use backend\modules\document\Module;
use Yii;

/**
 * Class ModuleTrait
 *
 */
trait ModuleTrait
{
    /**
     * @return Module
     */
    public function getModule()
    {
        return Yii::$app->getModule('document');
    }
}

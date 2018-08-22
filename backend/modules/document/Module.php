<?php

namespace backend\modules\document;

/**
 * document module definition class
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\document\controllers';

    public $modelClass = 'backend\modules\document\models\DocumentEntity';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

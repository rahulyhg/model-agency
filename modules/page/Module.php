<?php

namespace modules\page;

use Yii;

/**
 * page module definition class
 */
class Module extends \common\lib\Module
{
    const TRANSLATION_CATEGORY = 'modules/page';

    public $controllerNamespace = 'app\modules\page\backend\controllers';

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/page/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@modules/page/messages',
            'fileMap' => [
                'modules/page/attributeLabels' => 'attributeLabels.php',
            ]
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/page/' . $category, $message, $params, $language);
    }
}
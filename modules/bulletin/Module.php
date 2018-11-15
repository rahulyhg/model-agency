<?php

namespace modules\bulletin;

use Yii;

class Module extends \common\lib\Module
{
  public static function registerTranslations()
  {
    Yii::$app->i18n->translations['modules/bulletin/*'] = [
      'class' => 'yii\i18n\PhpMessageSource',
      'sourceLanguage' => 'ru-RU',
      'basePath' => '@modules/bulletin/messages',
      'fileMap' => [
        'modules/bulletin/attribute-list' => 'attribute-list.php',
        'modules/bulletin/categories' => 'categories.php',
        'modules/bulletin/client-card' => 'client-card.php',
        'modules/bulletin/vertical-card' => 'vertical-card.php',
        'modules/bulletin/common' => 'common.php',
        'modules/bulletin/adv-form' => 'adv-form.php',
      ]
    ];
  }

  public static function t($category, $message, $params = [], $language = null)
  {
    return Yii::t('modules/bulletin/' . $category, $message, $params, $language);
  }
}
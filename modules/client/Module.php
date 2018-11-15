<?php

namespace modules\client;

use Yii;

class Module extends \common\lib\Module
{
  public static function registerTranslations()
  {
    Yii::$app->i18n->translations['modules/client/*'] = [
      'class' => 'yii\i18n\PhpMessageSource',
      'sourceLanguage' => 'ru-RU',
      'basePath' => '@modules/client/messages',
      'fileMap' => [
        'modules/client/profile' => 'profile.php',
        'modules/client/auth' => 'auth.php',
        'modules/client/registration' => 'registration.php',
        'modules/client/client' => 'client.php',
      ]
    ];
  }

  public static function t($category, $message, $params = [], $language = null)
  {
    return Yii::t('modules/client/' . $category, $message, $params, $language);
  }
}
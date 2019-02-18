<?php
namespace modules\like;
use Yii;

class Module extends \common\lib\Module
{
  public static function registerTranslations()
  {
    Yii::$app->i18n->translations['modules/like/*'] = [
      'class' => 'yii\i18n\PhpMessageSource',
      'sourceLanguage' => 'en-US',
      'basePath' => '@modules/like/messages',
      'fileMap' => [
        'modules/like/common' => 'common.php',
      ]
    ];
  }

  public static function t($category, $message, $params = [], $language = null)
  {
    return Yii::t('modules/like/' . $category, $message, $params, $language);
  }
}
<?php
$params = array_merge(
  require __DIR__ . '/../../common/config/params.php',
  require __DIR__ . '/../../common/config/params-local.php',
  require __DIR__ . '/params.php',
  require __DIR__ . '/params-local.php'
);

return [
  'id' => 'app-frontend',
  'language' => 'ru-RU',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'controllerNamespace' => 'frontend\controllers',
  'components' => [
    'i18n' => [
      'translations' => [
        '*' => [
          'class' => 'yii\i18n\PhpMessageSource',
          'basePath' => '@frontend/messages',
          'sourceLanguage' => 'ru-RU',
          'fileMap' => [
            'header' => 'header.php',
          ],
        ],
      ],
    ],
    'theme' => [
      'class' => \frontend\components\theme\Theme::class,
    ],
    'request' => [
      'class' => \modules\lang\components\LangRequest::class,
      'csrfParam' => '_csrf-frontend',
    ],
    // todo: plug in module user instead
    'user' => [
      'identityClass' => 'common\models\User',
      'enableAutoLogin' => true,
      'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
    ],
    'session' => [
      // this is the name of the session cookie used for login on the frontend
      'name' => 'advanced-frontend',
    ],
    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],
    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'class' => \modules\lang\components\LangUrlManager::class,
      'rules' => [
        '/' => 'site/index',
        '/<slug:\w+>' => 'page/default/view'
      ],
    ],
  ],
  'params' => $params,
];

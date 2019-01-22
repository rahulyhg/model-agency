<?php
$params = array_merge(
  require __DIR__ . '/../../common/config/params.php',
  require __DIR__ . '/../../common/config/params-local.php',
  require __DIR__ . '/params.php',
  require __DIR__ . '/params-local.php'
);

return [
  'id' => 'app-backend',
  'language' => 'ru',
  'basePath' => dirname(__DIR__),
  'controllerNamespace' => 'backend\controllers',
  'bootstrap' => ['log'],
  'controllerMap' => [
    'elfinder' => [
      'class' => mihaildev\elfinder\Controller::className(),
      'access' => ['@'],
      //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
      'disabledCommands' => ['netmount', 'fullscreen', 'archive', 'duplicate', 'copy', 'cut'],
      //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
      'roots' => [
        [
          'baseUrl' => 'http://totocrm.loc/storage',
          'basePath' => realpath(dirname(__FILE__) . '/../../public_html/storage'),
          'name' => 'Storage'
        ],
      ]
    ],
  ],
  'modules' => [
    'gridview' => [
      'class' => '\kartik\grid\Module'
    ],
    'user' => [
      'class' => modules\user\Module::class,
    ],
  ],
  'components' => [
    'i18n' => [
      'translations' => [
        'yii2mod.comments' => [
          'class' => 'yii\i18n\PhpMessageSource',
          'basePath' => '@yii2mod/comments/messages',
        ],
        // ...
      ],
    ],
    'authManager' => [
      'class' => 'yii\rbac\PhpManager',
    ],
    'request' => [
      'csrfParam' => '_csrf-backend',
    ],
    'user' => [
      'identityClass' => 'common\models\User',
      'enableAutoLogin' => true,
      'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
    ],
    'session' => [
      // this is the name of the session cookie used for login on the backend
      'name' => 'advanced-backend',
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
      'rules' => [
      ],
    ],

  ],
  // Закрываем доступ ко всему кроме login для не авторизованных пользователей
  'as beforeRequest' => [
    'class' => yii\filters\AccessControl::class,
    'rules' => [
      [
        'allow' => true,
        'controllers' => ['public']
      ],
      [
        'allow' => true,
        'controllers' => ['site'],
        'actions' => ['login', 'create-one'],
      ],
      [
        'allow' => false,
        'roles' => ['?'],
      ],
      [
        'allow' => true,
        'roles' => ['@']
      ]
    ],
    'denyCallback' => function () {
      if (!Yii::$app->user->isGuest) {
        Yii::$app->user->logout();
      }
      return Yii::$app->response->redirect(['/site/login']);
    },
  ],
  'params' => $params,

];

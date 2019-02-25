<?php
return [
  'controllerMap' => [
    'file' => \common\components\filestorage\controllers\FileController::class,
    'like' => \modules\like\widgets\like\controllers\LikeWidgetController::class,
  ],
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
  ],
  'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
  'components' => [
    'view' => [
      'class' => \common\lib\View::class
    ],
    'setting' => [
      'class' => \modules\setting\components\SettingComponent::class,
    ],
    'banner' => [
      'class' => \modules\banner\components\BannerComponent::class,
    ],
    'filestorage' => [
      'class' => common\components\filestorage\FileStorage::class,
      'fileRoute' => '/file/index',
      'useFileController' => false,
      'storageUrl' => '/filestorage'
    ],
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'metronic' => [
      'class' => \common\components\metronic\Metronic::class
    ],
    /*'user' => [
      'identityClass' => \modules\mod\common\models\Mod::class,
      'enableAutoLogin' => true,
    ],*/
  ],
  'modules' => [
    'setting' => [
      'class' => modules\setting\Module::class,
    ],
    'block' => [
      'class' => modules\block\Module::class,
    ],
    'banner' => [
      'class' => modules\banner\Module::class,
    ],
    'mod' => [
      'class' => modules\mod\Module::class,
    ],
    'page' => [
      'class' => modules\page\Module::class
    ],
    'lang' => [
      'class' => modules\lang\Module::class,
    ],
    'like' => [
      'class' => modules\like\Module::class,
    ],
  ],
  'as initializer' => [
    'class' => common\initializers\ApplicationInitializer::class,
  ],
];

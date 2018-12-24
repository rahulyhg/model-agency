<?php
return [
  'controllerMap' => [
    'file' => \common\components\filestorage\controllers\FileController::class,
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
      'class' => common\components\filestorage\FileStorage::className(),
      'fileRoute' => '/file/index',
      'storagePath' => '/../filestorage'
    ],
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'metronic' => [
      'class' => \common\components\metronic\Metronic::class
    ],
  ],
  'modules' => [
    'page' => [
      'class' => modules\page\Module::class
    ],
    'lang' => [
      'class' => modules\lang\Module::class,
    ],
  ],
  'as initializer' => [
    'class' => common\initializers\ApplicationInitializer::class,
  ],
];

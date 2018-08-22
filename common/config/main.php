<?php
return [
	'controllerMap' => [
		'file' => \common\components\filestorage\controllers\FileController::class,
	],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
	    'view' => [
		    'class' => \common\lib\View::class
	    ],
	    'setting' => [
		    'class' => \common\components\setting\SettingComponent::class,
	    ],
	    'filestorage' => [
		    'class' => common\components\filestorage\FileStorage::className(),
		    'fileRoute' => '/file/index',
	    ],
      'cache' => [
          'class' => 'yii\caching\FileCache',
      ],
	    'metronic' => [
		    'class' => \common\components\metronic\Metronic::class
	    ],
    ],
];

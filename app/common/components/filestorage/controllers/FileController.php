<?php
namespace common\components\filestorage\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class FileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                ],
            ],
        ];
    }

    public function actionIndex($name)
    {
        $name = str_replace('/', DIRECTORY_SEPARATOR, urldecode($name));
        $filePath = \Yii::$app->filestorage->getFullFilePathByPath($name);
        $fileOriginalName = \Yii::$app->filestorage->getFileOriginalNameByPath($name);
        if (!$filePath || !is_file($filePath)) {
            throw new NotFoundHttpException();
        }
        return \Yii::$app->response->sendFile($filePath, $fileOriginalName, [
            'inline' => true
        ]);
    }
}
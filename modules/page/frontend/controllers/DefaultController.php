<?php

namespace modules\page\frontend\controllers;

use modules\page\common\models\Page;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{

  public function actionView($slug)
  {
    $model = $this->findModel($slug);
    return $this->render('view', ['model' => $model]);
  }

  protected function findModel($slug)
  {
    if (($model = Page::findOne(['slug' => $slug]))) {
      return $model;
    }
    throw new NotFoundHttpException('Page not found');
  }
}
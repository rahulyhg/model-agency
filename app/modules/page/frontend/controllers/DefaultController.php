<?php
namespace modules\page\frontend\controllers;

use modules\page\common\models\Page;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionView($slug)
    {
        $model = Page::findOne(['slug' => $slug]);
        return $this->render('view', [
            'model' => $model
        ]);
    }
}

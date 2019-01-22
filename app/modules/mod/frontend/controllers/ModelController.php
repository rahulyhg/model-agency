<?php
namespace modules\mod\frontend\controllers;

use modules\mod\common\models\Mod;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\web\Controller;

class ModelController extends Controller
{
  public function actionIndex()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Mod::find()
    ]);
    return $this->render('index', [
      'dataProvider' => $dataProvider
    ]);
  }
}
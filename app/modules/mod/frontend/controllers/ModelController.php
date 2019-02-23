<?php
namespace modules\mod\frontend\controllers;

use modules\mod\common\models\HairColor;
use modules\mod\common\models\Mod;
use modules\mod\frontend\forms\ModelFilterForm;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ModelController extends Controller
{
  public function actionIndex()
  {
    $filterForm = new ModelFilterForm();
    $showFilterForm = isset($_REQUEST[$filterForm->formName()]);
    $dataProvider = $filterForm->search(Yii::$app->request->queryParams);
    return $this->render('index', [
      'dataProvider' => $dataProvider,
      'filterForm' => $filterForm,
      'hairColorMap' => HairColor::getMap(),
      'showFilterForm' => $showFilterForm
    ]);
  }

  public function actionView($id)
  {
    $model = $this->findModel($id);
    return $this->render('view', [
      'model' => $model
    ]);
  }

  public function actionContact()
  {
    return $this->render('contact', []);
  }

  protected function findModel($id)
  {
    $model = Mod::findOne($id);
    if(!$model) {
      throw new NotFoundHttpException('not found');
    }
    return $model;
  }
}
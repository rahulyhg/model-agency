<?php

namespace modules\bulletin\frontend\controllers;


use modules\bulletin\common\models\Bulletin;
use modules\bulletin\common\models\BulletinStat;
use modules\bulletin\common\models\Category;
use modules\bulletin\frontend\forms\FilterForm;
use modules\client\common\models\Client;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{

  /**
   * Sing ads
   * @param $id
   * @return string
   * @throws NotFoundHttpException
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $stat = BulletinStat::findOne(['bulletin_id' => $model->id]);
    $stat->views = $stat->views + 1;
    $stat->save();
    return $this->render('view', [
      'model' => $model,
      'stat' => $stat
    ]);
  }

  /**
   * Action for ajax requests only
   * @param $id client ID
   * @return string
   * @throws BadRequestHttpException
   * @throws NotFoundHttpException
   */
  public function actionGetPhone($id)
  {
    if( !\Yii::$app->request->isAjax ) {
      throw new BadRequestHttpException('Only ajax requests are enabled!');
    }

    $client = Client::findOne($id);
    if(!$client) {
      throw new NotFoundHttpException('Client not found!');
    }

    return $client->phone;
  }

  public function actionCategory($id)
  {
    $category = $this->findCategory($id);
    $filterForm = new FilterForm();
    $dataProvider = $filterForm->search($this->findCategoriesIds($id), \Yii::$app->request->queryParams);
    return $this->render('category', [
      'filterForm' => $filterForm,
      'category' => $category,
      'dataProvider' => $dataProvider
    ]);
  }

  protected function findCategory($id)
  {
    if ($category = Category::findOne($id))
      return $category;
    throw new NotFoundHttpException('The requested page does not exist.');
  }

  protected function findCategoriesIds($id)
  {
    $ids = [$id];
    $tmpIds = Category::find()->where(['parent_id' => $id])->column();
    while (!empty($tmpIds)) {
      $ids = array_merge($ids, $tmpIds);
      $tmpIds = Category::find()->where(['parent_id' => $tmpIds])->column();
    }
    return $ids;
  }
  protected function findModel($id)
  {
    if (($model = Bulletin::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
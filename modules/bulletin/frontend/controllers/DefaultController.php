<?php

namespace modules\bulletin\frontend\controllers;


use modules\bulletin\backend\forms\GalleryForm;
use modules\bulletin\common\models\Bulletin;
use modules\bulletin\common\models\BulletinImage;
use modules\bulletin\common\models\BulletinStat;
use modules\bulletin\common\models\Category;
use modules\bulletin\common\types\AttributeTypeFilterManager;
use modules\bulletin\common\types\AttributeTypeManager;
use modules\bulletin\widgets\search\models\SearchForm;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

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
   * @param $id Bulletin ID
   * @return string
   * @throws BadRequestHttpException
   * @throws NotFoundHttpException
   */
  public function actionGetPhone($id)
  {
    if( !\Yii::$app->request->isAjax ) {
      throw new BadRequestHttpException('Only ajax requests are enabled!');
    }

    $bulletin = Bulletin::findOne($id);
    if(!$bulletin) {
      throw new NotFoundHttpException('Bulletin not found!');
    }

    $stat = BulletinStat::findOne(['bulletin_id' => $bulletin->id]);
    $stat->phoneViews = $stat->phoneViews + 1;
    $stat->save();

    return $bulletin->client->phone;
  }

  public function actionCategory($id)
  {
    $category = $this->findCategory($id);
    //$filterForm = new FilterForm();
    //$dataProvider = $filterForm->search($this->findCategoriesIds($id), \Yii::$app->request->queryParams);
    $filterManager = AttributeTypeFilterManager::createByCategory($category->id);
    $dataProvider = $filterManager->search($this->findCategoriesIds($id), \Yii::$app->request->queryParams);
    return $this->render('category', [
      //'filterForm' => $filterForm,
      'filterManager' => $filterManager,
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

  public function actionSearch()
  {
    $searchModel = new SearchForm();
    $dataProvider = $searchModel->search(Yii::$app->request->get());
    return $this->render('search', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider
    ]);
  }
}
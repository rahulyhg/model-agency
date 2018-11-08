<?php

namespace modules\bulletin\frontend\controllers;


use modules\bulletin\common\models\Bulletin;
use modules\bulletin\common\models\Category;
use modules\bulletin\common\types\AttributeTypeFilterManager;
use modules\bulletin\frontend\forms\FilterForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{

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
    while(!empty($tmpIds)){
      $ids = array_merge($ids, $tmpIds);
      $tmpIds = Category::find()->where(['parent_id' => $tmpIds])->column();
    }
    return $ids;
  }
}
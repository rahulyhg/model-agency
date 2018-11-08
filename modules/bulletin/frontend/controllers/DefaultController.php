<?php

namespace modules\bulletin\frontend\controllers;


use modules\bulletin\backend\forms\GalleryForm;
use modules\bulletin\common\models\Bulletin;
use modules\bulletin\common\models\BulletinImage;
use modules\bulletin\common\models\BulletinStat;
use modules\bulletin\common\models\Category;
use modules\bulletin\common\types\AttributeTypeFilterManager;
use modules\bulletin\common\types\AttributeTypeManager;
use modules\bulletin\frontend\forms\FilterForm;
use modules\client\common\models\Client;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

class DefaultController extends Controller
{

  public function actionCreate()
  {
    $model = new Bulletin();
    $galleryForm = new GalleryForm();
    $attributeTypeManager = null;

    if ($model->load(Yii::$app->request->post()) && $model->validate('category_id')) {
      $validated = true;
      $attributeTypeManager = AttributeTypeManager::createByCategory($model->category_id);
      if ($attributeTypeManager->loadModel(Yii::$app->request->post()) && ($validated = $attributeTypeManager->validateModel())) {
        $model->populateRelation('attributeVals', $attributeTypeManager->getModelsToSave());
      }
      $validated = $model->validate() && $validated;
      if ($validated && $galleryForm->load(Yii::$app->request->post())) {
        $bulletinImages = [];
        $images = $galleryForm->upload();
        if (is_array($images)) {
          foreach ($images as $imageId) {
            $bulletinImages[] = new BulletinImage(['image_id' => $imageId]);
          }
          $model->populateRelation('bulletinImages', $bulletinImages);
        }
      }
      if ($validated && $model->save(false)) {
        Yii::$app->session->setFlash('success', 'Запись успешно создана. ');
        return $this->redirect(['view', 'id' => $model->id]);
      }
    }

    $model->loadDefaultValues();

    return $this->render('create', [
      'model' => $model,
      'attributeTypeManager' => $attributeTypeManager,
      'galleryForm' => $galleryForm,
    ]);
  }

  public function actionDeleteImage()
  {
    $id = Yii::$app->request->post('key');
    if(is_numeric($id)){
      /**
       * @var $model BulletinImage
       */
      $model = BulletinImage::findOne($id);
      if($model) {
        return $model->delete();
      }
    }
    return false;
  }

  public function actionAttributeFields($categoryId, $id = null)
  {
    $attributeTypeManager = null;
    if ($id) {
      $model = $this->findModel($id);
      $attributeTypeManager = AttributeTypeManager::createByCategory($categoryId, $model->attributeVals);
    } else {
      $attributeTypeManager = AttributeTypeManager::createByCategory($categoryId);
    }
    $form = ActiveForm::begin(['options' => ['id' => 'bulletin-form']]);
    return $this->renderAjax('_attributes', [
      'form' => $form,
      'attributeTypeManager' => $attributeTypeManager,
      'registerJs' => true,
    ]);
  }

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
}
<?php
namespace modules\bulletin\frontend\controllers;

use modules\bulletin\backend\forms\GalleryForm;
use modules\bulletin\common\models\Bulletin;
use modules\bulletin\common\models\BulletinImage;
use modules\bulletin\common\models\BulletinStatus;
use modules\bulletin\common\types\AttributeTypeManager;
use Yii;
use yii\web\Controller;
use yii\widgets\ActiveForm;

class CreateController extends Controller
{
  public function actionStep1()
  {
    $model = new Bulletin();
    $galleryForm = new GalleryForm();
    $attributeTypeManager = null;

    $model->client_id = Yii::$app->user->id;
    $model->status_id = BulletinStatus::STATUS_DRAFT;

    /******************/
    $model->location_id = 1;
    /******************/

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
        return $this->redirect(['step2', 'id' => $model->id]);
      }
    }

    $model->loadDefaultValues();

    return $this->render('step1', [
      'model' => $model,
      'attributeTypeManager' => $attributeTypeManager,
      'galleryForm' => $galleryForm,
    ]);
  }

  public function actionStep2()
  {
    return $this->render('step2', []);
  }

  public function actionStep3()
  {
    return $this->render('step3', []);
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
}
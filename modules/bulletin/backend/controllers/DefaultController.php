<?php

namespace modules\bulletin\backend\controllers;

use modules\bulletin\backend\models\BulletinSearch;
use modules\bulletin\common\models\AttributeVal;
use modules\bulletin\common\types\AttributeTypeManager;
use Yii;
use modules\bulletin\common\models\Bulletin;
use backend\lib\Controller;
use yii\base\DynamicModel;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * DefaultController implements the CRUD actions for Bulletin model.
 */
class DefaultController extends Controller
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
    ];
  }

  /**
   * Lists all Bulletin models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new BulletinSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Creates a new Bulletin model.
   * If creation is successful, the browser will be redirected to the 'update' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Bulletin();
    $attributeTypeManager = null;
    if ($model->load(Yii::$app->request->post()) && $model->validate('category_id')) {
      $validated = true;
      $attributeTypeManager = AttributeTypeManager::createByCategory($model->category_id);
      if ($attributeTypeManager->loadModel(Yii::$app->request->post()) && ($validated = $attributeTypeManager->validateModel())) {
        $model->populateRelation('attributeVals', $attributeTypeManager->getModelsToSave());
      }
      $validated = $model->validate() && $validated;
      if ($validated && $model->save(false)) {
        Yii::$app->session->setFlash('success', 'Запись успешно создана. ' . Html::a(
            '<span><i class="la la-plus"></i><span>Новая запись</span></span>',
            ['create'],
            ['class' => 'btn btn-sm btn-accent m-btn--pill m-btn--icon m-btn--air']
          ));
        return $this->redirect(['update', 'id' => $model->id]);
      }
    }

    return $this->render('create', [
      'model' => $model,
      'attributeTypeManager' => $attributeTypeManager,
    ]);
  }

  /**
   * Updates an existing Bulletin model.
   * If update is successful, the browser will be redirected to the 'update' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    $lastCategoryId = $model->category_id;
    $attributeTypeManager = AttributeTypeManager::createByCategory($lastCategoryId, $model->attributeVals);

    if ($model->load(Yii::$app->request->post()) && $model->validate('category_id')) {
      if($lastCategoryId != $model->category_id){
        $attributeTypeManager = AttributeTypeManager::createByCategory($model->category_id);
      }
      $validated = true;
      if ($attributeTypeManager->loadModel(Yii::$app->request->post()) && ($validated = $attributeTypeManager->validateModel())) {
        $model->populateRelation('attributeVals', $attributeTypeManager->getModelsToSave());
      }
      $validated = $model->validate() && $validated;
      if ($validated && $model->save(false)) {
        Yii::$app->session->setFlash('success', 'Запись успешно обновлена.');
        return $this->redirect(['update', 'id' => $model->id]);
      }
    }

    return $this->render('update', [
      'model' => $model,
      'attributeTypeManager' => $attributeTypeManager,
    ]);
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
   * Deletes an existing Bulletin model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $model = $this->findModel($id);
    if ($model->delete()) {
      Yii::$app->session->setFlash('success', "Запись #$id успешно удалена.");
    }
    if (!empty($model->getErrors('deleteMessage'))) {
      Yii::$app->session->setFlash('error', $model->getErrors('deleteMessage'));
    }
    return $this->redirect(['index']);
  }

  /**
   * Deletes an existing Bulletin models.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @return \yii\web\Response
   * @throws \yii\web\BadRequestHttpException
   * @throws NotFoundHttpException
   */
  public function actionMultipleDelete()
  {
    if ($ids = Yii::$app->request->post('ids')) {
      $count = 0;
      $errorMessages = [];
      foreach ($this->findModels($ids) as $model) {
        if ($model->delete() !== false) {
          $count++;
        } else {
          if (!empty($model->getErrors('deleteMessage'))) {
            $errorMessages = array_merge($errorMessages, $model->getErrors('deleteMessage'));
          } else {
            $errorMessages = array_merge($errorMessages, ["Ошибка при удалении записи #$model->id."]);
          }
        }
      }
      if (!empty($errorMessages)) {
        Yii::$app->session->setFlash('error', $errorMessages);
      }
      if ($count > 0) {
        $message = '{n, plural, =1{Выбранная запись успешно удалена} few{Выбранные # записи успешно удалены} many{Выбранные # записей успешно удалены} other{Выбранные # записи успешно удалены}}.';
        Yii::$app->session->setFlash('success', \MessageFormatter::formatMessage('ru', $message, ['n' => $count]));
      }
      return $this->redirect(['index']);
    }
    throw new \yii\web\BadRequestHttpException();
  }

  /**
   * Finds the Bulletin model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Bulletin the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Bulletin::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

  /**
   * @param $ids
   * @return Bulletin[]
   * @throws NotFoundHttpException
   */
  protected function findModels($ids)
  {
    $models = Bulletin::findAll($ids);
    if (!empty($models)) {
      return $models;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
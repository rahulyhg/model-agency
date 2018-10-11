<?php

namespace modules\bulletin\backend\controllers;

use modules\bulletin\backend\services\AttributeService;
use modules\bulletin\common\models\AttributeType;
use modules\bulletin\common\types\forms\BaseForm;
use modules\bulletin\common\types\forms\IntegerForm;
use modules\bulletin\common\types\forms\SelectForm;
use Yii;
use modules\bulletin\common\models\Attribute;
use modules\bulletin\backend\models\AttributeSearch;
use backend\lib\Controller;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\helpers\Html;

/**
 * AttributeController implements the CRUD actions for Attribute model.
 */
class AttributeController extends Controller
{
  protected $attributeService;

  public function __construct($id, $module, AttributeService $attributeService, $config = [])
  {
    $this->attributeService = $attributeService;
    parent::__construct($id, $module, $config = []);
  }
  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
          'multiple-delete' => ['POST'],
        ],
      ],
    ];
  }

  /**
   * Lists all Attribute models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new AttributeSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Creates a new Attribute model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Attribute();
    $typeModel = null;
    if($typeId = Yii::$app->request->get('typeId')) {
      $model->type_id = $typeId;
      $typeModel = $this->attributeService->getTypeModel($typeId);
    }
    $post = Yii::$app->request->post();
    if ($model->load($post) && Model::loadMultiple($model->variationModels, $post)) {
      $validated = true;
      /**
       * @var $typeModel BaseForm
       */
      if(($typeModel && $typeModel->load($post) && ($validated = $typeModel->validate()))) {
        $model->type_settings = $typeModel->toTypeArray();//Json::encode($typeModel->toTypeArray());
        $model->setTrTypeSettingsFromArray($typeModel->toTrTypeArray());
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
      'typeModel' => $typeModel,
    ]);
  }



  /**
   * Updates an existing Attribute model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    $typeModel = $this->attributeService->getTypeModel($model->type_id, $model->type_settings/*Json::decode($model->type_settings)*/, $model->getTrTypeSettingsArray());
    if(($typeId = Yii::$app->request->get('typeId')) && $typeId != $model->type_id) {
      $model->type_id = $typeId;
      $typeModel = $this->attributeService->getTypeModel($typeId);
    }
    $post = Yii::$app->request->post();
    if ($model->load($post) && Model::loadMultiple($model->variationModels, $post)) {
      $validated = true;
      /**
       * @var $typeModel BaseForm
       */
      if(($typeModel && $typeModel->load($post) && ($validated = $typeModel->validate()))) {
        $model->type_settings = $typeModel->toTypeArray();//Json::encode($typeModel->toTypeArray());
        $model->setTrTypeSettingsFromArray($typeModel->toTrTypeArray());
      }
      $validated = $model->validate() && $validated;
      if ($validated && $model->save(false)) {
        Yii::$app->session->setFlash('success', 'Запись успешно обновлена.');
        return $this->redirect(['update', 'id' => $model->id]);
      }
    }
    return $this->render('update', [
      'model' => $model,
      'typeModel' => $typeModel,
    ]);
  }

  /**
   * Deletes an existing Attribute model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
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
   * Deletes an existing Attribute models.
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
   * Finds the Attribute model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Attribute the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Attribute::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  /**
   * @param $ids
   * @return Attribute[]
   * @throws NotFoundHttpException
   */
  protected function findModels($ids)
  {
    $models = Attribute::findAll($ids);
    if (!empty($models)) {
      return $models;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}

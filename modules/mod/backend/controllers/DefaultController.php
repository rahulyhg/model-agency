<?php

namespace modules\mod\backend\controllers;

use modules\mod\backend\models\ModImage;
use Yii;
use modules\mod\common\models\Mod;
use modules\mod\common\models\ModSearch;
use common\lib\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\helpers\Html;

/**
 * DefaultController implements the CRUD actions for Mod model.
 */
class DefaultController extends Controller
{
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
   * Lists all Mod models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new ModSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Creates a new Mod model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Mod();

    $post = Yii::$app->request->post();
    if ($model->load($post) && Model::loadMultiple($model->variationModels, $post) && $model->save()) {
      if ($imagesIds = $model->upload()) {
        if (is_array($imagesIds)) {
          $modImages = [];
          foreach ($imagesIds as $imageId) {
            $modImages[] = new ModImage([
              'entity_id' => $model->id,
              'image_id' => $imageId
            ]);
          }
          $transaction = Yii::$app->db->beginTransaction();
          foreach ($modImages as $modImage) {
            if (!$modImage->save()) {
              $transaction->rollBack();
              Yii::$app->session->setFlash('danger', 'При загрузке изображений произошла ошибка.');
              return false;
            }
          }
          $model->populateRelation('modImages', $modImages);
          $transaction->commit();
        }
      }

      Yii::$app->session->setFlash('success', 'Запись успешно создана. ' . Html::a(
          '<span><i class="la la-plus"></i><span>Новая запись</span></span>',
          ['create'],
          ['class' => 'btn btn-sm btn-accent m-btn--pill m-btn--icon m-btn--air']
        ));
      return $this->redirect(['update', 'id' => $model->id]);
    }
    return $this->render('create', [
      'model' => $model,
    ]);
  }

  /**
   * Updates an existing Mod model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    $post = Yii::$app->request->post();
    if ($model->load($post) && Model::loadMultiple($model->variationModels, $post) && $model->save()) {
      Yii::$app->session->setFlash('success', 'Запись успешно обновлена.');
      return $this->redirect(['update', 'id' => $model->id]);
    }
    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Mod model.
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
   * Deletes an existing Mod models.
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
   * Finds the Mod model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Mod the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Mod::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  /**
   * @param $ids
   * @return Mod[]
   * @throws NotFoundHttpException
   */
  protected function findModels($ids)
  {
    $models = Mod::findAll($ids);
    if (!empty($models)) {
      return $models;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}

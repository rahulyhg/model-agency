<?php

namespace backend\controllers;

use Yii;
use common\models\Lang;
use backend\models\LangSearch;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LangController implements the CRUD actions for Lang model.
 */
class LangController extends Controller
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
   * Lists all Lang models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new LangSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Lang model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new Lang model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Lang();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
   * Updates an existing Lang model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      Yii::$app->session->setFlash('success', 'Запись успешно обновлена.');
      return $this->redirect(['update', 'id' => $model->id]);
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Lang model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();
    Yii::$app->session->setFlash('success', "Запись #$id успешно удалена.");
    return $this->redirect(['index']);
  }

  /**
   * @return \yii\web\Response
   * @throws BadRequestHttpException
   * @throws NotFoundHttpException
   */
  public function actionMultipleDelete()
  {
    if ($ids = Yii::$app->request->post('ids')) {
      $count = 0;
      foreach ($this->findModels($ids) as $model) {
        if ($model->delete() !== false)
          $count++;
        else {
          Yii::$app->session->setFlash('danger', "Ошибка при удалении записи #$model->id.");
        }
      }
      if ($count > 0) {
        $message = '{n, plural, =1{Выбранная запись успешно удалена} few{Выбранные # записи успешно удалены} many{Выбранные # записей успешно удалены} other{Выбранные # записи успешно удалены}}.';
        Yii::$app->session->setFlash('success', \MessageFormatter::formatMessage('ru', $message, ['n' => $count]));
      }
      return $this->redirect(['index']);
    }
    throw new BadRequestHttpException();
  }

  /**
   * @param $ids
   * @return static[]
   * @throws NotFoundHttpException
   */
  protected function findModels($ids)
  {
    $models = Lang::findAll($ids);
    if (!empty($models)) {
      return $models;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

  /**
   * Finds the Lang model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Lang the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Lang::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}

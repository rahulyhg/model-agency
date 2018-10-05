<?php

namespace modules\client\backend\controllers;

use Yii;
use modules\client\common\models\Client;
    use modules\client\backend\models\ClientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
* DefaultController implements the CRUD actions for Client model.
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
    * Lists all Client models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Creates a new Client model.
    * If creation is successful, the browser will be redirected to the 'update' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new Client();

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
    * Updates an existing Client model.
    * If update is successful, the browser will be redirected to the 'update' page.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Запись успешно обновлена.');
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
        'model' => $model,
        ]);
    }

    /**
    * Deletes an existing Client model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete()) {
            Yii::$app->session->setFlash('success', "Запись #$id успешно удалена.");
        }
        if(!empty($model->getErrors('deleteMessage'))) {
            Yii::$app->session->setFlash('error', $model->getErrors('deleteMessage'));
        }
        return $this->redirect(['index']);
    }

    /**
    * Deletes an existing Client models.
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
                    if(!empty($model->getErrors('deleteMessage'))) {
                        $errorMessages = array_merge($errorMessages, $model->getErrors('deleteMessage'));
                    } else {
                        $errorMessages = array_merge($errorMessages, ["Ошибка при удалении записи #$model->id."]);
                    }
                }
            }
            if(!empty($errorMessages)) {
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
    * Finds the Client model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Client the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
    * @param $ids
    * @return Client[]
    * @throws NotFoundHttpException
    */
    protected function findModels($ids)
    {
        $models = Client::findAll($ids);
        if (!empty($models)) {
            return $models;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
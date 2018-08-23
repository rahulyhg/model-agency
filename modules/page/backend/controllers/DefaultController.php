<?php

namespace modules\page\backend\controllers;

use Yii;
use modules\page\common\models\Page;
use modules\page\backend\models\PageSearch;
use modules\page\lib\BlogController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Page model.
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
          'images-get' => [
            'class' => \vova07\imperavi\actions\GetImagesAction::class,
            'url' =>  Yii::getAlias('@web/redactor-storage'), // Directory URL address, where files are stored.
            'path' => Yii::getAlias('@webroot/redactor-storage'), // Or absolute path to directory where files are stored.
            'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']], // These options are by default.
          ],
          'image-upload' => [
            'class' => \vova07\imperavi\actions\UploadFileAction::class,
            'url' => Yii::getAlias('@web/redactor-storage'), // Directory URL address, where files are stored.
            'path' => Yii::getAlias('@webroot/redactor-storage'), // Or absolute path to directory where files are stored.
          ],
          'file-delete' => [
            'class' => \vova07\imperavi\actions\DeleteFileAction::class,
            'url' => Yii::getAlias('@web/redactor-storage'), // Directory URL address, where files are stored.
            'path' => Yii::getAlias('@webroot/redactor-storage'), // Or absolute path to directory where files are stored.
          ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash(
		        'success',
		        'Successfully created'
	        );

	        return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash(
		        'success',
		        'Successfully updated'
	        );
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

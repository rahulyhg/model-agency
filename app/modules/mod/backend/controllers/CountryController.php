<?php

namespace modules\mod\backend\controllers;

use modules\lang\common\models\Lang;
use modules\mod\common\models\CountryLang;
use Yii;
use modules\mod\common\models\Country;
use modules\mod\common\models\CountrySearch;
use common\lib\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
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
   * Lists all Country models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new CountrySearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Creates a new Country model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Country();

    $post = Yii::$app->request->post();
    if ($model->load($post) && Model::loadMultiple($model->variationModels, $post) && $model->save()) {
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

  public function actionFillCountryFromJson($lang_id = false)
  {
    if ($lang_id === false && $currentLang = Lang::findOne(['ietf_tag' => Yii::$app->language])) {
      $lang_id = $currentLang->id;
    } else {
      $lang_id = Lang::findOne(['is_default' => 1])->id;
    }

    $countriesJson = file_get_contents(Yii::getAlias('@modules') . '/mod/lib/country.json');
//    $countriesJson = Yii::$app->request->post('fileJson');
//    if(isset($_FILES)){
//      $countriesJson = $_FILES['fileJson'];
//    } else {
//      return false;
//    }
    if(!$countriesJson) return false;
    $countries = json_decode($countriesJson, true);
    unset($countriesJson);

    foreach ($countries as $country) {
      $countryObject = new Country();
      if (!$countryObject->save()) return false;

      $countryLangObject = new CountryLang([
        'entity_id' => $countryObject->id,
        'lang_id' => $lang_id,
        'name' => $country
      ]);
      if (!$countryLangObject->save()) return false;
    }

    return $this->redirect('index');
  }

  /**
   * Updates an existing Country model.
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
   * Deletes an existing Country model.
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
   * Deletes an existing Country models.
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
        //Yii::$app->session->setFlash('success', \MessageFormatter::formatMessage('ru', $message, ['n' => $count]));
      }
      return $this->redirect(['index']);
    }
    throw new \yii\web\BadRequestHttpException();
  }

  /**
   * Finds the Country model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Country the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Country::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  /**
   * @param $ids
   * @return Country[]
   * @throws NotFoundHttpException
   */
  protected function findModels($ids)
  {
    $models = Country::findAll($ids);
    if (!empty($models)) {
      return $models;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}

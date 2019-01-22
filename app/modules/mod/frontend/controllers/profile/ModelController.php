<?php
namespace modules\mod\frontend\controllers\profile;

use modules\mod\common\models\ModUser;
use Yii;
use yii\base\Model;
use yii\web\Controller;

class ModelController extends Controller
{
  public function actionIndex()
  {
    /**
     * @var $modUser ModUser
     */
    $modUser = \Yii::$app->user->identity;
    $model = $modUser->mod;

    $transaction = \Yii::$app->db->beginTransaction();
    $modUserSave = false;
    $modelSave = false;
    $post = Yii::$app->request->post();
    if($modUser->load($post) && $modUser->save()) {
      $modUserSave = true;
    }
    if($model->load($post) && $model->save()) {
      $modelSave = true;
    }
    if( $modUserSave && $modelSave ) {
      \Yii::$app->session->setFlash('success', 'Successfully saved!');
      $transaction->commit();
    } else {
      $transaction->rollBack();
    }
    return $this->render('index', [
      'modUser' => $modUser,
      'model' => $model
    ]);
  }

  public function actionPhoto()
  {
    return $this->render('photo');
  }

  public function actionPayment()
  {
    return $this->render('payment');
  }
}
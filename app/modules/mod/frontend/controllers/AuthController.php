<?php
namespace modules\mod\frontend\controllers;

use modules\mod\frontend\forms\ModelLoginForm;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
  public function actionModel()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }
    $model = new ModelLoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      Yii::$app->session->setFlash('success', 'Вы успешно вошли в личный кабинет. С возвращением!');
      return $this->goBack();
    } else {
      $model->password = '';

      return $this->render('model', [
        'model' => $model,
      ]);
    }
  }

  public function actionManager()
  {
    return $this->render('manager');
  }

  /**
   * @return \yii\web\Response
   */
  public function actionLogout()
  {
    Yii::$app->user->logout();
    Yii::$app->session->setFlash('success', 'You have successfully logged out of your account.');
    return $this->goHome();
  }
}
<?php
namespace modules\mod\frontend\controllers;

use modules\mod\frontend\forms\ModelSignUpForm;
use Yii;
use yii\web\Controller;

class SignupController extends Controller
{
  public function actionModel()
  {
    if(!Yii::$app->user->isGuest) {
      return $this->redirect(['/mod/profile/model/index']);
    }

    $model = new ModelSignUpForm();
    if ($model->load(Yii::$app->request->post())) {
      if ($user = $model->signup()) {
        if (Yii::$app->getUser()->login($user)) {
          return $this->goHome();
        }
      }
    }

    return $this->render('model', [
      'model' => $model,
    ]);
  }

  public function actionManager()
  {
    return $this->render('manager');
  }
}
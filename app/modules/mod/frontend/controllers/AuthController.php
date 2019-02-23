<?php
namespace modules\mod\frontend\controllers;

use modules\mod\frontend\forms\ModelLoginForm;
use modules\mod\frontend\models\PasswordResetRequestForm;
use modules\mod\frontend\models\ResetPasswordForm;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
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

  /**
   * Requests password reset.
   *
   * @return mixed
   */
  public function actionRequestPasswordReset()
  {
    $model = new PasswordResetRequestForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      if ($model->sendEmail()) {
        $email = Yii::$app->user->identity->email;
        Yii::$app->session->setFlash('success', "На Ваш email {$email} было отправлено письмо с дальнейшими инструкциями по сбросу пароля.");

        return $this->goHome();
      } else {
        Yii::$app->session->setFlash('error', 'Извините, мы не можем сбросить пароль для этого email.');
      }
    }

    return $this->render('requestPasswordResetToken', [
      'model' => $model,
    ]);
  }

  /**
   * Resets password.
   *
   * @param string $token
   * @return mixed
   * @throws BadRequestHttpException
   */
  public function actionResetPassword($token)
  {
    try {
      $model = new ResetPasswordForm($token);
    } catch (InvalidParamException $e) {
      throw new BadRequestHttpException($e->getMessage());
    }

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
      Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');

      return $this->goHome();
    }

    return $this->render('resetPassword', [
      'model' => $model,
    ]);
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
    Yii::$app->session->setFlash('success', 'Вы успешно вышли с личного кабинета. До встречи на Celeb Cloud!');
    return $this->goHome();
  }
}
<?php
namespace backend\lib;

class Controller extends \yii\web\Controller
{
  public function beforeAction($action) {
    $formTokenName = \Yii::$app->params['form_token_param'];

    if ($formTokenValue = \Yii::$app->request->post($formTokenName)) {
      $sessionTokenValue = \Yii::$app->session->get($formTokenName);

      if ($formTokenValue != $sessionTokenValue ) {
        throw new \yii\web\HttpException(400, 'The form token could not be verified. Duplicate post submission.');
      }

      \Yii::$app->session->remove($formTokenName);
    }

    return parent::beforeAction($action);
  }
}
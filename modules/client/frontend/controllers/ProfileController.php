<?php
namespace modules\client\frontend\controllers;

use modules\bulletin\common\models\Bulletin;
use modules\client\common\models\Client;
use yii\web\Controller;

class ProfileController extends Controller
{
  public function actionIndex()
  {
    $client = Client::findOne(\Yii::$app->user->id);
    if( $client->load(\Yii::$app->request->post()) && $client->save() ) {
      \Yii::$app->session->setFlash('success', 'Ваши изменения успешно сохранены!');
    }
    return $this->render('index', [
      'client' => $client,
      'activeBulletins' => Bulletin::find()->where(['client_id' => \Yii::$app->user->id])->all(),
      'noActiveBulletins' => Bulletin::find()->where(['client_id' => \Yii::$app->user->id])->all()
    ]);
  }
}
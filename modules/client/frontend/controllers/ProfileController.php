<?php

namespace modules\client\frontend\controllers;

use modules\bulletin\common\models\Bulletin;
use modules\bulletin\common\models\BulletinStatus;
use modules\client\common\models\Client;
use yii\web\Controller;

class ProfileController extends Controller
{
  public function actionIndex()
  {
    $client = Client::findOne(\Yii::$app->user->id);
    if ($client->load(\Yii::$app->request->post()) && $client->save()) {
      \Yii::$app->session->setFlash('success', 'Ваши изменения успешно сохранены!');
    }
    return $this->render('index', [
      'client' => $client,
      'activeBulletins' => Bulletin::find()
        ->where([
          'status_id' => BulletinStatus::STATUS_PUBLISH
        ])
        ->orWhere([
          'status_id' => BulletinStatus::STATUS_DRAFT
        ])
        ->andWhere([
          'client_id' => \Yii::$app->user->id
        ])
        ->all(),
      'notActiveBulletins' => Bulletin::find()
        ->where([
          'client_id' => \Yii::$app->user->id,
          'status_id' => BulletinStatus::STATUS_NOT_ACTIVE
        ])
        ->all()
    ]);
  }

  public function actionActivationBulletin($id)
  {
    $model = Bulletin::findOne($id);
    if ($model) {
      $model->status_id = BulletinStatus::STATUS_DRAFT;
      if ($model->save()) {
        \Yii::$app->session->setFlash('success', 'Объявление успешно активировано и будет опубликовано после проверки модератором.');
        $this->redirect('index');
      } else {
        \Yii::$app->session->setFlash('danger', 'Ошибка активации!');
      }
    } else {
      \Yii::$app->session->setFlash('danger', 'Ошибка. Объявление не найдено!');
    }
    $this->redirect('index');
  }

  public function actionDeactivationBulletin($id)
  {
    $model = Bulletin::findOne($id);
    if ($model) {
      $model->status_id = BulletinStatus::STATUS_NOT_ACTIVE;
      if ($model->save()) {
        \Yii::$app->session->setFlash('success', 'Объявление успешно деактивировано!');
        $this->redirect('index');
      } else {
        \Yii::$app->session->setFlash('danger', 'Ошибка деактивации!');
      }
    } else {
      \Yii::$app->session->setFlash('danger', 'Ошибка. Объявление не найдено!');
    }
    $this->redirect('index');
  }
}
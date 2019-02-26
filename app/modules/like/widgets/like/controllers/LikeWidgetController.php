<?php

namespace modules\like\widgets\like\controllers;

use modules\like\common\models\Like;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

class LikeWidgetController extends Controller
{
  public function actionAdd()
  {
    if (!\Yii::$app->request->isAjax) {
      throw new BadRequestHttpException('only ajax!');
    }
    \Yii::$app->response->format = Response::FORMAT_JSON;
    $entityId = intval(\Yii::$app->request->post('entityId'));
    $entity = strval(\Yii::$app->request->post('entity'));
    if(!$this->canCurrentUserAddLike($entity, $entityId)) {
      return [
        'status' => 'error',
        'message' => 'Вы уже поставили свой лайк :)'
      ];
    }
    $like = new Like([
      'entity' => $entity,
      'entity_id' => $entityId,
      'ip' => \Yii::$app->request->userIP,
      'user_id' => \Yii::$app->user->id ?: null
    ]);
    if ($like->save()) {
      return [
        'status' => 'success',
        'count' => Like::find()->where(['entity_id' => $entityId, 'entity' => $entity])->count()
      ];
    }
    return [
      'status' => 'error',
      'message' => 'Возникла ошибка!'
    ];
  }

  protected function canCurrentUserAddLike(string $entity, int $entityId): bool
  {
    $user = \Yii::$app->user->identity;
    if($user && Like::findOne(['user_id' => $user->id, 'entity_id' => $entityId, 'entity' => $entity])) {
      return false;
    }
    $ip = \Yii::$app->request->userIP;
    if($ip && Like::findOne(['ip' => $ip, 'entity_id' => $entityId, 'entity' => $entity])) {
      return false;
    }
    return true;
  }
}
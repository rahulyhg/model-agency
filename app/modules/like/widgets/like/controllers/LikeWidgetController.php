<?php

namespace modules\like\widgets\like\controllers;

use modules\like\common\models\Like;
use Yii;
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
      $this->setCookie($entity, $entityId);
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

  /**
   * @param string $entity
   * @param int $entityId
   */
  protected function setCookie(string $entity, int $entityId)
  {
    $cookies = Yii::$app->response->cookies;
    $cookies->add(new \yii\web\Cookie([
      'name' => "like-$entity-$entityId",
      'value' => true,
    ]));
  }

  protected function likeCookieExist($entity, $entityId)
  {
    return isset($_COOKIE["like-$entity-$entityId"]);
  }

  /**
   * @param string $entity
   * @param int $entityId
   * @return bool
   */
  protected function canCurrentUserAddLike(string $entity, int $entityId): bool
  {
    // check by user
    $user = \Yii::$app->user->identity;
    if($user && Like::findOne(['user_id' => $user->id, 'entity_id' => $entityId, 'entity' => $entity])) {
      return false;
    }
    // check by ip
    $ip = \Yii::$app->request->userIP;
    if($ip && Like::findOne(['ip' => $ip, 'entity_id' => $entityId, 'entity' => $entity])) {
      return false;
    }
    // check by cookie
    if($this->likeCookieExist($entity, $entityId)) {
      return false;
    }
    return true;
  }
}
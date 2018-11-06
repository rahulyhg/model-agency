<?php

namespace modules\bulletin\common\behaviors;

use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\Json;

class AttributeJsonBehavior extends \common\behaviors\JsonBehavior
{
  public function onBeforeSave(Event $event)
  {
    /** @var ActiveRecord $model */
    $model = $event->sender;
    $jsonField = $this->getJsonField($model);
    $value = $model->{$this->property};
    if(is_array($value) || is_object($value)){
      $value = Json::encode($value);
    }
    $model->setAttribute($jsonField, $value);
  }
}
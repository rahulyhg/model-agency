<?php

namespace common\behaviors;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * public function behaviors()
 * {
 *  return [
 *      [
 *          'class' => JsonBehavior::class,
 *          'property' => 'meta',
 *          'jsonField' => 'meta_json'
 *      ]
 *  ];
 * }
 *
 * @property string $property Свойство содержащее объект или массив до конвертации в формат JSON
 * @property string $jsonField Поле таблицы для хранения данных в формате JSON
 */
class JsonBehavior extends Behavior
{
  public $property;
  public $jsonField;

  /**
   * Список событий на которые зарегистрировано выполнение указанных методов
   * @return array
   */
  public function events()
  {
    return [
      ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
      ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
      ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
    ];
  }

  public function onAfterFind($event)
  {
    /** @var ActiveRecord $model */
    $model = $event->sender;
    $jsonField = $this->getJsonField($model);
    $attribute = $model->getAttribute($jsonField);
    if (!is_array($attribute)) {
      $model->{$this->property} = Json::decode($attribute);
    }
  }

  public function onBeforeSave(Event $event)
  {
    /** @var ActiveRecord $model */
    $model = $event->sender;
    $jsonField = $this->getJsonField($model);
    $model->setAttribute($jsonField, Json::encode($model->{$this->property}));
  }

  protected function getJsonField(ActiveRecord $model)
  {
    $jsonField = $this->jsonField ?: $this->property;
    if (!$model->hasAttribute($jsonField)) {
      throw new \DomainException("Field $jsonField with type JSON does not exist in the table " . $model::tableName());
    }
    return $jsonField;
  }
}
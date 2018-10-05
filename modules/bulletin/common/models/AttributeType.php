<?php

namespace modules\bulletin\common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%attribute_type}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property Attribute[] $attributes0
 */
class AttributeType extends \common\lib\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%attribute_type}}';
  }

  protected static $_map;

  public static function getMap()
  {
    if (!isset(self::$_map))
      self::$_map = ArrayHelper::map(self::find()->orderBy('name')->all(), 'id', 'name');
    return self::$_map;
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'name'], 'required'],
      [['name'], 'string', 'max' => 255],
      [['id'], 'integer'],
      [['id'], 'unique'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'name' => 'Name',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getAttributes0()
  {
    return $this->hasMany(Attribute::className(), ['type_id' => 'id']);
  }

  public function beforeDelete()
  {
    if (!parent::beforeDelete()) {
      return false;
    }
    $flag = true;
    if (Attribute::find()->where(['type_id' => $this->id])->count() > 0) {
      $this->addError('deleteMessage', 'Нельзя удалить запись #' . $this->id . ', т.к. она связана с аттрибутами.');
      $flag = false;
    }
    return $flag;
  }

  public static function getProcessClass($id)
  {
    switch ($id) {
      case 1:
        return \modules\bulletin\common\types\MoneyType::class;
      case 2:
        return \modules\bulletin\common\types\IntegerType::class;
      case 6:
        return \modules\bulletin\common\types\SelectType::class;
      case 4:
        return \modules\bulletin\common\types\CheckboxType::class;
      default:
        return \modules\bulletin\common\types\BaseType::class;
    }
  }
}

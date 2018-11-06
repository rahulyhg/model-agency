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
      'name' => 'Название',
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

  const MONEY = 1;
  const INTEGER = 2;
  const CHECKBOX = 3;
  const CHECKBOX_LIST = 4;
  const SELECT = 5;

  public static function getProcessClass($id)
  {
    switch ($id) {
      case self::MONEY:
        return \modules\bulletin\common\types\MoneyType::class;
      case self::INTEGER:
        return \modules\bulletin\common\types\IntegerType::class;
      case self::CHECKBOX:
        return \modules\bulletin\common\types\CheckboxType::class;
      case self::CHECKBOX_LIST:
        return \modules\bulletin\common\types\CheckboxListType::class;
      case self::SELECT:
        return \modules\bulletin\common\types\SelectType::class;
      default:
        return \modules\bulletin\common\types\BaseType::class;
    }
  }

  public static function getFormClass($id)
  {
    switch ($id) {
      case self::MONEY:
        return \modules\bulletin\common\types\forms\MoneyForm::class;
      case self::INTEGER:
        return \modules\bulletin\common\types\forms\IntegerForm::class;
      case self::CHECKBOX:
        return null;
      case self::CHECKBOX_LIST:
        return \modules\bulletin\common\types\forms\CheckboxListForm::class;
      case self::SELECT:
        return \modules\bulletin\common\types\forms\SelectForm::class;
      default:
        return null;
    }
  }
}

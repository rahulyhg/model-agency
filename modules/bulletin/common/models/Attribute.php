<?php

namespace modules\bulletin\common\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $type_settings
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AttributeType $type
 * @property AttributeLang[] $translations
 * @property AttributeVal[] $attributeVals
 * @property CategoryAttribute[] $categoryAttributes
 * @property string $tr_type_settings translatable type settings
 */
class Attribute extends \modules\lang\lib\TranslatableActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%attribute}}';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['type_id'], 'required'],
      [['type_id', 'created_at', 'updated_at'], 'integer'],
      [['type_settings'], 'safe'],
      [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeType::class, 'targetAttribute' => ['type_id' => 'id']],
    ];
  }

  public function behaviors()
  {
    return array_merge(parent::behaviors(), [
      [
        'class' => \common\behaviors\JsonBehavior::class,
        'property' => 'type_settings',
      ]
    ]);
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'type_id' => 'Тип',
      'type_settings' => 'Type Settings',
      'created_at' => 'Дата создания',
      'updated_at' => 'Дата последнего обновления',
    ];
  }

  /**
   * @param $trArr array
   */
  public function setTrTypeSettingsFromArray(array $trArr)
  {
    foreach ($this->variationModels as $translation) {
      foreach ($trArr as $langId => $val) {
        if ($translation->lang_id == $langId) {
          $translation->tr_type_settings = $val;//Json::encode($val);
          break;
        }
      }
    }
  }

  public function getTrTypeSettingsArray()
  {
    $trTypeArr = [];
    foreach ($this->variationModels as $translation) {
      if ($translation->tr_type_settings) {
        $trTypeArr[$translation->lang_id] = $translation->tr_type_settings;//Json::decode($translation->tr_type_settings);
      } else {
        $trTypeArr[$translation->lang_id] = [];
      }
    }
    return $trTypeArr;
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getType()
  {
    return $this->hasOne(AttributeType::class, ['id' => 'type_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getAttributeVals()
  {
    return $this->hasMany(AttributeVal::class, ['attribute_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCategoryAttributes()
  {
    return $this->hasMany(CategoryAttribute::class, ['attribute_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTranslations()
  {
    return $this->hasMany(AttributeLang::class, ['entity_id' => 'id']);
  }

  public function beforeDelete()
  {
    if (!parent::beforeDelete()) {
      return false;
    }
    $flag = true;
    if ($this->getAttributeVals()->count() > 0) {
      $this->addError('deleteMessage', 'Нельзя удалить атрибут #' . $this->id . ', т.к. он связан с объявлениями.');
      $flag = false;
    }
    return $flag;
  }

  protected static $_map;

  public static function getMap()
  {
    if (!isset(self::$_map)) {
      self::$_map = \yii\helpers\ArrayHelper::map(
        self::find()
          ->joinWith('translations tr')
          ->orderBy('tr.name')
          ->all(), 'id', function ($model) {
        return "#" . $model->id . " " . $model->name;
      });
    }
    return self::$_map;
  }

  /**
   * @param $categoryId
   * @return array|self[]
   */
  public static function findByCategory($categoryId)
  {
    return Attribute::find()
      ->joinWith(['categoryAttributes ca', 'translations'])
      ->where(['ca.category_id' => $categoryId])
      ->all();
  }

  public function getTypeClass()
  {
    return AttributeType::getProcessClass($this->type_id);
  }

  protected static $_moneyId;
  public static function moneyId()
  {
    if(self::$_moneyId)
      return self::$_moneyId;
    $attribute = self::findOne(['type_id' => AttributeType::MONEY]);
    if($attribute){
      return self::$_moneyId = $attribute->id;
    }
    return null;
  }

}

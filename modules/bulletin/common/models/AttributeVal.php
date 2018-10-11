<?php

namespace modules\bulletin\common\models;

use Yii;

/**
 * This is the model class for table "{{%attribute_val}}".
 *
 * @property int $id
 * @property int $attribute_id
 * @property int $entity_id
 * @property string $val
 *
 * @property Attribute $attribute0
 * @property Bulletin $entity
 */
class AttributeVal extends \common\lib\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attribute_val}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_id',], 'required'],
            [['attribute_id', 'entity_id'], 'integer'],
//            [['val'], 'string'],
            [['val'], 'safe'],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bulletin::className(), 'targetAttribute' => ['entity_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_id' => 'Attribute ID',
            'entity_id' => 'Entity ID',
            'val' => 'Значение',
        ];
    }

//    public function setVal($value)
//    {
//        $this->val = json_encode($value);
//    }
//
//    public function getVal()
//    {
//        return json_decode($this->val);
//    }

  public function behaviors()
  {
    return array_merge(parent::behaviors(), [
      [
        'class' => \common\behaviors\JsonBehavior::class,
        'property' => 'val',
      ]
    ]);
  }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Bulletin::className(), ['id' => 'entity_id']);
    }
}

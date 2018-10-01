<?php

namespace modules\bulletin\common\models;

use Yii;

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
            [['type_settings'], 'string'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'type_settings' => 'Type Settings',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AttributeType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeVals()
    {
        return $this->hasMany(AttributeVal::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttributes()
    {
        return $this->hasMany(CategoryAttribute::className(), ['attribute_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(AttributeLang::className(), ['entity_id' => 'id']);
    }
}

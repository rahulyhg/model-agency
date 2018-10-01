<?php

namespace modules\bulletin\common\models;

use Yii;

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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

    public function beforeDelete() {
        if ( ! parent::beforeDelete() ) {
            return false;
        }
        $flag = true;
        if ( Attribute::find()->where( [ 'type_id' => $this->id ] )->count() > 0 ) {
            $this->addError( 'deleteMessage', 'Нельзя удалить запись #' . $this->id . ', т.к. она связана с аттрибутами.' );
            $flag = false;
        }
        return $flag;
    }
}

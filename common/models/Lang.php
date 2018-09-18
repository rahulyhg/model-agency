<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%lang}}".
 *
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string $ietf_tag
 * @property int $is_default
 * @property int $created_at
 * @property int $updated_at
 */
class Lang extends \common\lib\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lang}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'required'],
            [['id', 'is_default', 'created_at', 'updated_at'], 'integer'],
            [['name', 'label', 'ietf_tag'], 'string', 'max' => 64],
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
            'label' => 'Label',
            'ietf_tag' => 'Ietf Tag',
            'is_default' => 'Is Default',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

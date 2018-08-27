<?php

namespace modules\setting\common\models;

use modules\setting\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "setting_setting".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $section
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 */
class Setting extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting_setting}}';
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
          TimestampBehavior::class
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value', 'section'], 'required'],
            [['value', 'section', 'description'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
//        return [
//            'id' => 'ID',
//            'key' => 'Ключ',
//            'value' => 'Значение',
//            'section' => 'Секция',
//            'description' => 'Описание',
//            'created_at' => 'Дата создания',
//            'updated_at' => 'Дата последнего обновления',
//        ];
        return [
            'id' => Module::t('attributeLabels', 'id'),
            'key' => Module::t('attributeLabels', 'key'),
            'value' => Module::t('attributeLabels', 'value'),
            'section' => Module::t('attributeLabels', 'section'),
            'description' => Module::t('attributeLabels', 'description'),
            'created_at' => Module::t('attributeLabels', 'created_at'),
            'updated_at' => Module::t('attributeLabels', 'updated_at'),
        ];
    }
}

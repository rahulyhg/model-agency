<?php

namespace modules\bulletin\common\models;

use Yii;

/**
 * This is the model class for table "{{%service}}".
 *
 * @property integer $id
 * @property integer $duration
 * @property string $price
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ServiceBulletin[] $serviceBulletins
 * @property ServiceLang[] $translations
 */
class Service extends \modules\lang\lib\TranslatableActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['duration', 'price'], 'required'],
            [['duration', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'duration' => 'Продолжительность',
            'price' => 'Цена',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceBulletins()
    {
        return $this->hasMany(ServiceBulletin::className(), ['service_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(ServiceLang::className(), ['entity_id' => 'id']);
    }
}

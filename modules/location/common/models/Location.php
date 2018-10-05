<?php

namespace modules\location\common\models;

use Yii;

/**
 * This is the model class for table "{{%location}}".
 *
 * @property integer $id
 *
 * @property Bulletin[] $bulletins
 * @property Client[] $clients
 * @property LocationLang[] $translations
 */
class Location extends \modules\lang\lib\TranslatableActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBulletins()
    {
        return $this->hasMany(Bulletin::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['location_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(LocationLang::className(), ['entity_id' => 'id']);
    }
}

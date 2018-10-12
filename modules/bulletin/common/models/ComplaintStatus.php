<?php

namespace modules\bulletin\common\models;

use Yii;

/**
 * This is the model class for table "{{%complaint_status}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Complaint[] $complaints
 * @property ComplaintStatusLang[] $translations
 */
class ComplaintStatus extends \modules\lang\lib\TranslatableActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%complaint_status}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplaints()
    {
        return $this->hasMany(Complaint::class, ['status_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(ComplaintStatusLang::class, ['entity_id' => 'id']);
    }

    protected static $_map;

    public static function getMap()
    {
        if(!isset(self::$_map)) {
            self::$_map = \yii\helpers\ArrayHelper::map(
                self::find()
                  ->joinWith('translations tr')
                  ->orderBy('tr.name')
                  ->all(), 'id', 'name'
            );
        }
        return self::$_map;
    }
}

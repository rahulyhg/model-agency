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
    public function getTranslations()
    {
        return $this->hasMany(LocationLang::class, ['entity_id' => 'id']);
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

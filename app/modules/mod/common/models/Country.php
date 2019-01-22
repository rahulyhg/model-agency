<?php

namespace modules\mod\common\models;

use Yii;

/**
 * This is the model class for table "{{%country}}".
 *
 * @property integer $id
 * @property string $tel_code
 */
class Country extends \modules\lang\lib\TranslatableActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tel_code'], 'string', 'max' => 5],
            [['tel_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tel_code' => 'Tel Code',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(CountryLang::class, ['entity_id' => 'id']);
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

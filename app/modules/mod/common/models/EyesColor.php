<?php

namespace modules\mod\common\models;

use Yii;

/**
 * This is the model class for table "{{%eyes_color}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property EyesColorLang[] $translations
 * @property Mod[] $mods
 */
class EyesColor extends \modules\lang\lib\TranslatableActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eyes_color}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
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
    public function getMods()
    {
        return $this->hasMany(Mod::class, ['eyes_color_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(EyesColorLang::class, ['entity_id' => 'id']);
    }

    protected static $_map;

    public static function getMap()
    {
        if(!isset(self::$_map)) {
            self::$_map = \yii\helpers\ArrayHelper::map(
                self::find()
                  ->joinWith('translations tr')
                  ->orderBy('tr.color')
                  ->all(), 'id', 'color'
            );
        }
        return self::$_map;
    }
}

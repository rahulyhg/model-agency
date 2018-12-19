<?php

namespace modules\mod\common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%mod}}".
 *
 * @property integer $id
 * @property integer $bust
 * @property integer $waist
 * @property integer $hips
 * @property integer $eyes_color_id
 * @property integer $hair_color_id
 * @property integer $shoes
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property EyesColor $eyesColor
 * @property HairColor $hairColor
 * @property ModLang[] $translations
 */
class Mod extends \modules\lang\lib\TranslatableActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mod}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bust', 'waist', 'hips', 'eyes_color_id', 'hair_color_id', 'shoes', 'created_at', 'updated_at'], 'integer'],
            [['eyes_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => EyesColor::class, 'targetAttribute' => ['eyes_color_id' => 'id']],
            [['hair_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => HairColor::class, 'targetAttribute' => ['hair_color_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bust' => 'Bust',
            'waist' => 'Waist',
            'hips' => 'Hips',
            'eyes_color_id' => 'Eyes Color ID',
            'hair_color_id' => 'Hair Color ID',
            'shoes' => 'Shoes',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEyesColor()
    {
        return $this->hasOne(EyesColor::class, ['id' => 'eyes_color_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHairColor()
    {
        return $this->hasOne(HairColor::class, ['id' => 'hair_color_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(ModLang::class, ['entity_id' => 'id']);
    }

    protected static $_map;

    public static function getMap()
    {
        if(!isset(self::$_map)) {
            self::$_map = \yii\helpers\ArrayHelper::map(
                self::find()
                  ->joinWith('translations tr')
                  ->orderBy('tr.first_name')
                  ->all(), 'id', 'first_name'
            );
        }
        return self::$_map;
    }
}

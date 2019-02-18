<?php

namespace modules\mod\common\models;

use Yii;

/**
 * This is the model class for table "{{%mod_spoken_lang}}".
 *
 * @property int $id
 * @property int $mod_id
 * @property int $spoken_lang_id
 *
 * @property Mod $mod
 * @property SpokenLang $spokenLang
 */
class ModSpokenLang extends \common\lib\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mod_spoken_lang}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mod_id', 'spoken_lang_id'], 'required'],
            [['mod_id', 'spoken_lang_id'], 'integer'],
            [['mod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mod::class, 'targetAttribute' => ['mod_id' => 'id']],
            [['spoken_lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpokenLang::class, 'targetAttribute' => ['spoken_lang_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mod_id' => 'Mod ID',
            'spoken_lang_id' => 'Spoken Lang ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMod()
    {
        return $this->hasOne(Mod::class, ['id' => 'mod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpokenLang()
    {
        return $this->hasOne(SpokenLang::class, ['id' => 'spoken_lang_id']);
    }
}

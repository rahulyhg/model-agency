<?php

namespace modules\mod\common\models;

use Yii;
use modules\lang\common\models\Lang;

/**
* This is the model class for table "{{%mod_lang}}".
*
* @property integer $id
* @property integer $lang_id
* @property integer $entity_id
*
* @property Lang $lang
* @property Mod $entity
*/
class ModLang extends \modules\lang\lib\LangActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '{{%mod_lang}}';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['lang_id'], 'required'],
            [['lang_id', 'entity_id'], 'integer'],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lang::class, 'targetAttribute' => ['lang_id' => 'id']],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mod::class, 'targetAttribute' => ['entity_id' => 'id']],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lang_id' => 'Lang ID',
            'entity_id' => 'Entity ID',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getLang()
    {
        return $this->hasOne(Lang::class, ['id' => 'lang_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEntity()
    {
        return $this->hasOne(Mod::class, ['id' => 'entity_id']);
    }
}

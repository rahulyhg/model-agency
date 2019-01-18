<?php

namespace modules\mod\common\models;

use Yii;
use modules\lang\common\models\Lang;

/**
* This is the model class for table "{{%country_lang}}".
*
* @property integer $id
* @property integer $entity_id
* @property integer $lang_id
* @property string $name
*/
class CountryLang extends \modules\lang\lib\LangActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '{{%country_lang}}';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['entity_id', 'lang_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'lang_id' => 'Lang ID',
            'name' => 'Name',
        ];
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getLang()
    {
        return $this->hasOne(Lang::class, ['id' => 'lang_id']);
    }
}

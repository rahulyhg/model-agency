<?php

namespace modules\bulletin\common\models;

use Yii;
use modules\lang\common\models\Lang;

/**
* This is the model class for table "{{%category_attribute_group_lang}}".
*
* @property integer $id
* @property integer $entity_id
* @property integer $lang_id
* @property string $name
*
* @property CategoryAttributeGroup $entity
*/
class CategoryAttributeGroupLang extends \modules\lang\lib\LangActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '{{%category_attribute_group_lang}}';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['entity_id', 'lang_id'], 'integer'],
            [['lang_id'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryAttributeGroup::class, 'targetAttribute' => ['entity_id' => 'id']],
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
            'name' => 'Название',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEntity()
    {
        return $this->hasOne(CategoryAttributeGroup::class, ['id' => 'entity_id']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getLang()
    {
        return $this->hasOne(Lang::class, ['id' => 'lang_id']);
    }
}

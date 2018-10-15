<?php

namespace modules\bulletin\common\models;

use Yii;
use modules\lang\common\models\Lang;

/**
* This is the model class for table "{{%attribute_lang}}".
*
* @property integer $id
* @property integer $entity_id
* @property integer $lang_id
* @property string $name
* @property string $tr_type_settings
*
* @property Attribute $entity
*/
class AttributeLang extends \modules\lang\lib\LangActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '{{%attribute_lang}}';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['entity_id', 'lang_id'], 'integer'],
            [['lang_id', 'name'], 'required'],
            [['tr_type_settings'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::class, 'targetAttribute' => ['entity_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
          [
            'class' => \common\behaviors\JsonBehavior::class,
            'property' => 'tr_type_settings',
          ]
        ]);
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
            'tr_type_settings' => 'Tr Type Settings',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEntity()
    {
        return $this->hasOne(Attribute::class, ['id' => 'entity_id']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getLang()
    {
        return $this->hasOne(Lang::class, ['id' => 'lang_id']);
    }
}

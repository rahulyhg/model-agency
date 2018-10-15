<?php

namespace modules\bulletin\common\models;

use Yii;
use modules\lang\common\models\Lang;

/**
* This is the model class for table "{{%category_lang}}".
*
* @property integer $id
* @property integer $entity_id
* @property integer $lang_id
* @property string $name
*
* @property Category $entity
*/
class CategoryLang extends \modules\lang\lib\LangActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '{{%category_lang}}';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['entity_id', 'lang_id'], 'integer'],
            [['lang_id', 'name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['entity_id' => 'id']],
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
        return $this->hasOne(Category::className(), ['id' => 'entity_id']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getLang()
    {
        return $this->hasOne(Lang::className(), ['id' => 'lang_id'])->alias(self::$counter++);
    }

    public static $counter = 1;
}

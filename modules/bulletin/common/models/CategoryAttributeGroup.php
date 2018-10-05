<?php

namespace modules\bulletin\common\models;

use Yii;

/**
 * This is the model class for table "{{%category_attribute_group}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CategoryAttribute[] $categoryAttributes
 * @property CategoryAttributeGroup $parent
 * @property CategoryAttributeGroup[] $categoryAttributeGroups
 * @property CategoryAttributeGroupLang[] $translations
 */
class CategoryAttributeGroup extends \modules\lang\lib\TranslatableActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category_attribute_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'created_at', 'updated_at'], 'integer'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryAttributeGroup::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttributes()
    {
        return $this->hasMany(CategoryAttribute::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CategoryAttributeGroup::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttributeGroups()
    {
        return $this->hasMany(CategoryAttributeGroup::className(), ['parent_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(CategoryAttributeGroupLang::className(), ['entity_id' => 'id']);
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

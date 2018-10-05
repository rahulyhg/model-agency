<?php

namespace modules\bulletin\common\models;

use Yii;
use yii2tech\ar\position\PositionBehavior;

/**
 * This is the model class for table "{{%category_attribute}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $attribute_id
 * @property int $group_id
 * @property int $position
 *
 * @property Attribute $attribute0
 * @property Category $category
 * @property CategoryAttributeGroup $group
 */
class CategoryAttribute extends \common\lib\ActiveRecord
{
    const WIDGET_ITEM = '.attributes-item';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category_attribute}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_id'], 'required'],
            [['category_id', 'attribute_id', 'group_id', 'position'], 'integer'],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryAttributeGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'attribute_id' => 'Attribute ID',
            'group_id' => 'Group ID',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CategoryAttributeGroup::className(), ['id' => 'group_id']);
    }
}

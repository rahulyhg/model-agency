<?php

namespace modules\bulletin\common\models;

use common\models\DynamicModel;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Bulletin[] $bulletins
 * @property Category $parent
 * @property Category[] $categories
 * @property CategoryAttribute[] $categoryAttributes
 * @property CategoryLang[] $translations
 */
class Category extends \modules\lang\lib\TranslatableActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'created_at', 'updated_at'], 'integer'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
    public function getBulletins()
    {
        return $this->hasMany(Bulletin::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttributes()
    {
        return $this->hasMany(CategoryAttribute::class, ['category_id' => 'id'])->orderBy(['position' => SORT_ASC]);
    }

    protected $_groupedCategoryAttributes;

    /**
     * @return CategoryAttribute[][]
     */
    public function getGroupedCategoryAttributes($groupIds)
    {
        if($this->_groupedCategoryAttributes) {
            return $this->_groupedCategoryAttributes;
        }
        $groupedCategoryAttributes = ArrayHelper::index($this->categoryAttributes, null, 'group_id');
        foreach($groupIds as $groupId) {
            if(empty($groupedCategoryAttributes[$groupId])) {
                $groupedCategoryAttributes[$groupId] = [new CategoryAttribute(['group_id' => $groupId])];
            }
        }
        return $this->_groupedCategoryAttributes = $groupedCategoryAttributes;
    }


    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(CategoryLang::className(), ['entity_id' => 'id']);
    }

    public function beforeValidate()
    {
        if(parent::beforeValidate()) {
            return self::validateMultiple($this->categoryAttributes);
        }
        return false;
    }

    public function load($data, $formName = null)
    {
        if (parent::load($data, $formName)) {
            $categoryAttributeData = (new CategoryAttribute())->parsePostData($data);
            $categoryAttributes = DynamicModel::createMultiple(CategoryAttribute::class, $this->categoryAttributes ? : [], $categoryAttributeData);
            self::loadMultiple($categoryAttributes, $categoryAttributeData);
            $this->populateRelation('categoryAttributes', $categoryAttributes);
            return true; //если min == 0 return true здесь и не проверять loadmultiple, если min > 1 return true выше в if блоке проверки loadmultiple
        }
        return false;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $db = $this->getDb();
        $tr = $db->beginTransaction();
        try {
            $categoryAttributes = $this->categoryAttributes;
            if (parent::save($runValidation, $attributeNames)) {
                foreach ($categoryAttributes as $index => $categoryAttribute) {
                    $categoryAttribute->category_id = $this->id;
                }
                if(!CategoryAttribute::validateUniqueAttribute($categoryAttributes)) {
                    $tr->rollBack();
                    return false;
                }
                $notDeletedIds = [];
                foreach ($categoryAttributes as $index => $categoryAttribute) {
                    $categoryAttribute->position = $index;
                    if (!$categoryAttribute->save(false)) {
                        $tr->rollBack();
                        return false;
                    }
                    $notDeletedIds[] = $categoryAttribute->id;
                }
                if (!$this->isNewRecord) {
                    CategoryAttribute::deleteAll(
                      ['and', ['not in', 'id', $notDeletedIds], ['category_id' => $this->id]]
                    );
                }
                $tr->commit();
                return true;
            }
        } catch (Exception $ex) {
            $tr->rollBack();
        }
        return false;
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

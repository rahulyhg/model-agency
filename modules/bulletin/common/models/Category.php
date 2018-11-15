<?php

namespace modules\bulletin\common\models;

use common\behaviors\UploadFileBehavior;
use common\models\DynamicModel;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $icon_file_id
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
  const ICON_DIR = 'bulletin\category\icons';

  public $newPassword;
  public $newPasswordRepeat;
  public $deleteIconFile = 0;
  public $iconFile;

  private $iconUrl;
  private $iconSize;

  /**
   * @return null|string
   */
  public function getIconUrl()
  {
    if (!$this->iconUrl) {
      $this->iconUrl = Yii::$app->filestorage->getFileUrl($this->icon_file_id);
      if (!$this->iconUrl) {
        $this->iconUrl = Yii::$app->setting->get('bulletin', 'category_default_icon') ?: null;
      }
    }

    return $this->iconUrl;
  }


  public function behaviors()
  {
    return ArrayHelper::merge([
      [
        'class' => UploadFileBehavior::class,
        'files' => [
          [
            'fileAttribute' => 'iconFile',
            'idAttribute' => 'icon_file_id',
            'deleteAttribute' => 'deleteIconFile',
          ],
        ],
        'directory' => self::ICON_DIR,
      ]
    ], parent::behaviors());
  }

  /**
   * @return int|string
   */
  public function getIconSize()
  {
    if (!$this->iconSize) {
      $path = Yii::$app->filestorage->getFilePath($this->icon_file_id);

      return $this->iconSize = $path ? filesize($path) : 0;
    }

    return $this->iconSize;
  }

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
      [['deleteIconFile'], 'boolean'],
      [
        ['iconFile'],
        'file',
        'maxSize' => 50000 /* 50 кб */,
        'skipOnEmpty' => true,
        'tooBig' => 'Эта иконка слишком большая. Максимальный размер: 50kb.',
        'extensions' => ['jpg', 'png', 'jpeg'],
        'wrongExtension' => 'Не правильный формат. Разрешенные форматы: jpg, jpeg, png.',
      ],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'parent_id' => 'Родительская категория',
      'created_at' => 'Дата создания',
      'updated_at' => 'Дата последнего обновления',
      'icon_file_id' => 'Иконка',
      'iconFile' => 'Иконка',
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

  public function getChildCategories()
  {
    return Category::find()->where(['parent_id' => $this->id])->all();
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
    if ($this->_groupedCategoryAttributes) {
      return $this->_groupedCategoryAttributes;
    }
    $groupedCategoryAttributes = ArrayHelper::index($this->categoryAttributes, null, 'group_id');
    foreach ($groupIds as $groupId) {
      if (empty($groupedCategoryAttributes[$groupId])) {
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
    if (parent::beforeValidate()) {
      return self::validateMultiple($this->categoryAttributes);
    }
    return false;
  }

  public function load($data, $formName = null)
  {
    if (parent::load($data, $formName)) {
      $categoryAttributeData = (new CategoryAttribute())->parsePostData($data);
      $categoryAttributes = DynamicModel::createMultiple(CategoryAttribute::class, $this->categoryAttributes ?: [], $categoryAttributeData);
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
        $this->populateRelation('categoryAttributes', $categoryAttributes);
        foreach ($categoryAttributes as $index => $categoryAttribute) {
          $categoryAttribute->category_id = $this->id;
        }
        if (!CategoryAttribute::validateUniqueAttribute($categoryAttributes)) {
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

  public function beforeDelete()
  {
    if (!parent::beforeDelete()) {
      return false;
    }
    $flag = true;
    if ($this->getCategories()->count() > 0) {
      $this->addError('deleteMessage', 'Нельзя удалить категорию #' . $this->id . ', т.к. она имеет подкатегории.');
      $flag = false;
    }
    if ($this->getBulletins()->count() > 0) {
      $this->addError('deleteMessage', 'Нельзя удалить категорию #' . $this->id . ', т.к. она связана с объявлениями.');
      $flag = false;
    }
    return $flag;
  }

  protected $_parents;

  public function getParents()
  {
    if (!$this->_parents) {
      $parents = [];
      $category = $this;
      do {
        if ($category->parent) {
          $parents[] = $category->parent;
        }
        $category = $category->parent;
      } while ($category);
      $this->_parents = array_reverse($parents);
    }
    return $this->_parents;
  }

  protected static $_map;

  public static function getMap()
  {
    if (!isset(self::$_map)) {
      self::$_map = \yii\helpers\ArrayHelper::map(
        self::find()
          ->joinWith('translations tr')
          ->orderBy('tr.name')
          ->all(), 'id', 'name'
      );
    }
    return self::$_map;
  }

//  protected static $_treeMap;
//
//  public static function getTreeMap()
//  {
//    if (!isset(self::$_map)) {
//      self::$_treeMap = self::getTree();
//    }
//    return self::$_treeMap;
//  }
//
//  private static function getTree(Category $category = null)
//  {
//    if($category === null) {
//      $categories = self::find()
//        ->where(['parent_id' => null])
//        ->joinWith('translations tr')
//        ->orderBy('tr.name')
//        ->all();
//    } else {
//      $categories = self::find()
//        ->where(['parent_id' => $category->id])
//        ->joinWith('translations tr')
//        ->orderBy('tr.name')
//        ->all();
//    }
//    foreach ($categories as $category) {
//      $result[$category->id] = $category->name;
//    }
//    return $tree;
//  }

  protected static $_parentMap;

  public static function getParentMap()
  {
    if (!isset(self::$_parentMap)) {
      self::$_parentMap = \yii\helpers\ArrayHelper::map(
        self::find()->alias('c')
          ->joinWith('translations tr')
          ->where(['not', ['c.parent_id' => null]])
          ->orderBy('tr.name')
          ->all(), 'parent.id', 'parent.name'
      );
    }
    return self::$_parentMap;
  }

  /**
   * Возворащает категории верхнего уровня у которых нет родителей
   * @return array|\yii\db\ActiveRecord[]
   */
  public static function getTopLevelCategories()
  {
    return Category::find()->where(['parent_id' => null])->all();
  }
}

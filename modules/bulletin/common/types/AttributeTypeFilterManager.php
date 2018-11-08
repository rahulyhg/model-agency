<?php

namespace modules\bulletin\common\types;


use modules\bulletin\common\models\Attribute;
use modules\bulletin\common\models\AttributeVal;
use modules\bulletin\common\models\Bulletin;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class AttributeTypeFilterManager extends BaseObject
{
  CONST POSTS_PER_PAGE = 7;

  /**
   * @var DynamicForm
   */
  public $model;

  /**
   * @var BaseType[][]
   */
  public $groupedFields = [];

  public function init()
  {
    $tempAttributes = [];
    $tempLabels = [];
    foreach ($this->groupedFields as $fields) {
      foreach ($fields as $id => $field) {
        $tempLabels = array_merge($tempLabels, $field->getFilterLabels());
        $tempAttributes = array_merge($tempAttributes, $field->getFilterAttributes());
      }
    }
    $this->model = new DynamicForm($tempAttributes, ['formName' => 'search']);
    $this->model->setAttributeLabels($tempLabels);

    foreach ($this->groupedFields as $fields) {
      foreach ($fields as $id => $field) {
        foreach ($field->getFilterRules() as $slug => $rules) {
          foreach ($rules as $key => $value) {
            if (is_array($value)) {
              $this->model->addRule($slug, $key, $value);
            } else {
              $this->model->addRule($slug, $value);
            }
          }
        }
      }
    }
  }

  /**
   * @return array
   */
  public function generateFilterFields()
  {
    $formFields = [];
    foreach ($this->groupedFields as $group => $fields) {
      foreach ($fields as $id => $field) {
        $formFields[$group][] = $field->generateFilterField($this->model);
      }
    }
    return $formFields;
  }

  public function search($category, $params)
  {
    $query = Bulletin::find()->alias('b')->select('b.*')
      ->where(['b.category_id' => $category]);

    if (Attribute::moneyId()) {
      $query->addSelect('av.val price');
      $query->leftJoin(AttributeVal::tableName() . ' av', 'b.id = av.entity_id AND av.attribute_id=' . Attribute::moneyId());
    }

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => [
        'defaultPageSize' => self::POSTS_PER_PAGE,
      ],
      'sort' => [
        'defaultOrder' => [
          'created_at' => SORT_DESC,
        ],
      ]
    ]);

    if (Attribute::moneyId()) {
      $dataProvider->sort->attributes['price'] = [
        'asc' => ['CAST(price as UNSIGNED)' => SORT_ASC],
        'desc' => ['CAST(price as UNSIGNED)' => SORT_DESC],
      ];
    }

    if (!$this->model->load($params) || !$this->model->validate()) {
      return $dataProvider;
    }

    foreach ($this->groupedFields as $fields) {
      foreach ($fields as $id => $field) {
        $field->addFilterFieldWhere($query, $this->model);
      }
    }

    return $dataProvider;
  }

  public static function createByCategory($categoryId)
  {
    $groupedFields = [];
    foreach (Attribute::findByCategory($categoryId) as $attribute) {
      $params = ['id' => $attribute->id, 'name' => $attribute->name, 'slug' => $attribute->slug];
      $type_settings = ArrayHelper::merge(
        ($attribute->type_settings) ? : [],
        ($attribute->tr_type_settings) ? : []
      );
      $params = ArrayHelper::merge($params, $type_settings);
      $typeClass = $attribute->getTypeClass();
      $groupedFields[$attribute->getGroup($categoryId)][$attribute->id] = new $typeClass($params);
    }
    $obj = new self([
      'groupedFields' => $groupedFields,
    ]);
    return $obj;
  }
}
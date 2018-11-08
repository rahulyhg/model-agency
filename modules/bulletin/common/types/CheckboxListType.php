<?php

namespace modules\bulletin\common\types;


use yii\db\ActiveQuery;
use yii\helpers\Json;

class CheckboxListType extends BaseType
{
  public $items = [];

  public function init()
  {
    if(empty($this->rules['each']) && !empty($this->items)) {
      $this->rules['each'] = ['rule' => ['in', 'range' => array_keys($this->items)]];
    }
    parent::init();
  }

  public function generateValueField($form, $model, $name)
  {
    return parent::generateValueField($form, $model, $name)->checkboxList($this->items);
  }

  public function getFilterRules()
  {
    return [
      $this->slug => [
        'each' => ['rule' => ['in', 'range' => array_keys($this->items)]],
      ],
    ];
  }

  /**
   * @param $query ActiveQuery
   * @param $model
   */
  public function addFilterFieldWhere($query, $model)
  {
    $alias = 'av'.$this->id;
    if (!empty($model->{$this->slug})) {
      $query->joinWith("attributeVals $alias");
      $query->andFilterWhere(["and", ["$alias.attribute_id" => $this->id], "json_contains($alias.val, '" . Json::encode($model->{$this->slug}) . "') = 1"]);
    }
  }

  public function generateFilterField($model)
  {
    return \Yii::$app->view->renderFile('@modules/bulletin/frontend/views/types/checkboxlist.php', [
      'filterForm' => $model,
      'name' => $this->slug,
      'items' => $this->items,
    ]);
  }
}
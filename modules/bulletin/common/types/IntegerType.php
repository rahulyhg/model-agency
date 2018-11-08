<?php

namespace modules\bulletin\common\types;


use yii\db\ActiveQuery;

class IntegerType extends BaseType
{
  protected $defaultRules = [
    'integer'
  ];

  public function getFilterAttributes()
  {
    return [$this->getFromAttribute(), $this->getToAttribute()];
  }

  public function getFilterLabels()
  {
    return [
      $this->getFromAttribute() => $this->name . ' от',
      $this->getToAttribute() => $this->name . ' до',
    ];
  }

  public function getFilterRules()
  {
    return [
      $this->getFromAttribute() => [
        'integer'
      ],
      $this->getToAttribute() => [
        'integer'
      ]
    ];
  }

  protected function getFromAttribute()
  {
    return $this->slug . '_from';
  }

  protected function getToAttribute()
  {
    return $this->slug . '_to';
  }

  /**
   * @param $query ActiveQuery
   * @param $model
   */
  public function addFilterFieldWhere($query, $model)
  {
    $alias = 'av'.$this->id;
    if (!empty($model->{$this->getFromAttribute()}) && !empty($model->{$this->getToAttribute()})) {
      $query->joinWith("attributeVals $alias");
      $query->andFilterWhere(["and", ["$alias.attribute_id" => $this->id], ["between", "$alias.val", intval($model->{$this->getFromAttribute()}), intval($model->{$this->getToAttribute()})]]);
    } elseif (!empty($model->{$this->getFromAttribute()})) {
      $query->joinWith("attributeVals $alias");
      $query->andFilterWhere(["and", ["$alias.attribute_id" => $this->id], [">=", "$alias.val", intval($model->{$this->getFromAttribute()})]]);
    } elseif (!empty($model->{$this->getToAttribute()})) {
      $query->joinWith("attributeVals $alias");
      $query->andFilterWhere(["and", ["$alias.attribute_id" => $this->id], ["<=", "$alias.val", intval($model->{$this->getToAttribute()})]]);
    }
  }

  public function generateFilterField($model)
  {
    return \Yii::$app->view->renderFile('@modules/bulletin/frontend/views/types/integer.php', [
      'filterForm' => $model,
      'nameFrom' => $this->getFromAttribute(),
      'nameTo' => $this->getToAttribute(),
    ]);
  }
}
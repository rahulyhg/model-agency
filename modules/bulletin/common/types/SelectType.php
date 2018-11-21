<?php

namespace modules\bulletin\common\types;


use yii\db\ActiveQuery;

class SelectType extends BaseType
{
  public $items = [];

  public function init()
  {
    if(empty($this->rules['in']) && !empty($this->items)) {
      $this->rules['in'] = ['range' => array_keys($this->items)];
    }
    parent::init();
  }

  public function generateValueField($form, $model, $name, $options = [])
  {
    return parent::generateValueField($form, $model, $name, [
      'options' => [
        'class' => 'b-field-select'
      ]
    ])->widget(\kartik\widgets\Select2::class, [
      'data' => $this->items,
      'options' => ['placeholder' => ''],
      'pluginOptions' => ['allowClear' => true]
    ]);
  }

  public function getFilterRules()
  {
    return [
      $this->slug => [
        'in' => ['range' => array_keys($this->items)],
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
    if (!$this->isNullOrEmptyString($model->{$this->slug})) {
      $query->joinWith("attributeVals $alias");
      $query->andFilterWhere(["and", ["$alias.attribute_id" => $this->id], ["$alias.val" => $model->{$this->slug}]]);
    }
  }

  protected function isNullOrEmptyString($str)
  {
    return (!isset($str) || trim($str) === '');
  }

  public function generateFilterField($model)
  {
    return \Yii::$app->view->renderFile('@modules/bulletin/frontend/views/types/select.php', [
      'filterForm' => $model,
      'name' => $this->slug,
      'items' => $this->items,
    ]);
  }

  /**
   * Возвращает значение типа в том виде, который нужен на frontend
   * @param $val
   * @return string
   */
  public function getValue($val): string
  {
    return $this->items[intval($val)];
  }
}
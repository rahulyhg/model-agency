<?php

namespace modules\bulletin\common\types;


use yii\db\ActiveQuery;

class CheckboxType extends BaseType
{
  protected $defaultRules = [
    'boolean'
  ];

  public function generateValueField($form, $model, $name)
  {
    return parent::generateValueField($form, $model, $name)->checkbox(/*['label' => $this->name]*/);
  }

  public function getFilterRules()
  {
    return [
      $this->slug => [
        'boolean'
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
      $query->andFilterWhere(["and", ["$alias.attribute_id" => $this->id], ["$alias.val" => $model->{$this->slug}]]);
    }
  }

  public function generateFilterField($model)
  {
    return \Yii::$app->view->renderFile('@modules/bulletin/frontend/views/types/checkbox.php', [
      'filterForm' => $model,
      'name' => $this->slug,
    ]);
  }

  /**
   * Возвращает значение типа в том виде, который нужен на frontend
   * @param $val
   * @return string
   */
  public function getValue($val): string
  {
    return intval($val) === 1 ? 'Да' : 'Нет';
  }
}
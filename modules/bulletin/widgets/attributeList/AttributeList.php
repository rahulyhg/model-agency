<?php
namespace modules\bulletin\widgets\attributeList;

use modules\bulletin\common\models\Bulletin;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class AttributeList extends Widget
{
  /**
   * @var Bulletin
   */
  public $model;

  /**
   * @var string
   */
  public $elementClass = '';

  public function init()
  {
    if( !$this->model instanceof Bulletin ) {
      throw new InvalidConfigException('model property must be an instance of Bulletin');
    }
    parent::init();
  }

  public function run()
  {
    $list = [];
    foreach ($this->model->attributeVals as $attributeVal) {
      $params = ['id' => $attributeVal->attribute0->id, 'name' => $attributeVal->attribute0->name, 'slug' => $attributeVal->attribute0->slug];
      $type_settings = ArrayHelper::merge(
        ($attributeVal->attribute0->type_settings) ? : [],
        ($attributeVal->attribute0->tr_type_settings) ? : []
      );
      $params = ArrayHelper::merge($params, $type_settings);
      $typeClass = $attributeVal->attribute0->getTypeClass();
      $processClass = new $typeClass($params);
      $list[$attributeVal->attribute0->name] = $processClass->getValue($attributeVal->val);
    }
    return $this->render('index', [
      'list' => $list,
      'elementClass' => $this->elementClass
    ]);
  }
}
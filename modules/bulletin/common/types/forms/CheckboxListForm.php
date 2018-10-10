<?php

namespace modules\bulletin\common\types\forms;


use modules\lang\common\models\Lang;
use yii\base\Model;

class CheckboxListForm extends BaseForm
{
  /**
   * @var ItemsForm[]
   */
  public $items;

  public function init()
  {
    $this->items = $this->adjustItems($this->items ?: []);
    parent::init();
  }

  public function rules()
  {
    return [
    ];
  }

  public function load($data, $formName = null)
  {
    $loaded = self::loadMultiple($this->items, $data);
    return $loaded;
  }

  public function validate($attributeNames = null, $clearErrors = true)
  {
    $validated = parent::validate($attributeNames, $clearErrors);
    $validated = self::validateMultiple($this->items) && $validated;
    return $validated;
  }

  protected function adjustItems($initialItems = [])
  {
    $langs = Lang::find()->all();
    $items = [];
    foreach ($langs as $lang) {
      $matchFound = false;
      foreach($initialItems as $initialItem) {
        if($lang->id == $initialItem->lang_id) {
          $items[] = $initialItem;
          $matchFound = true;
          break;
        }
      }
      if(!$matchFound) {
        $items[] = new ItemsForm(['lang_id' => $lang->id]);
      }
    }
    return $items;
  }

  public static function createFromTypeArray($arr, $trArr)
  {
    $params = [];
    foreach($trArr as $lang => $value) {
      if(isset($value['items'])) {
        $params['items'][] = ItemsForm::createFromArray($lang, $value['items']);
      }
    }
    return new self($params);
  }

  public function toTrTypeArray()
  {
    $arr = [];
    foreach($this->items as $item) {
      $arr[$item->lang_id]['items'] = $item->valToArray();
    }
    return $arr;
  }
}
<?php

namespace modules\bulletin\common\typesfilter\forms;


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
    $validated = $this->validateLang() && $validated;
    return $validated;
  }

  protected function validateLang()
  {
    $validated = true;
    $itemKey = array_keys($this->items)[0];
    foreach($this->items as $key => $item) {
      if($item->lang_id == Lang::getDefaultLangId()){
        $itemKey = $key;
        break;
      }
    }
    $arrayCount = count($this->items[$itemKey]->valToArray());
    foreach($this->items as $item) {
      if(!$item->isEmpty()){
        $item->arrayCount = $arrayCount;
        $validated = $item->validate() && $validated;
      }
    }
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
      if($item->isEmpty()) {
        $arr[$item->lang_id] = null;
      } else {
        $arr[$item->lang_id]['items'] = $item->valToArray();
      }
    }
    return $arr;
  }
}
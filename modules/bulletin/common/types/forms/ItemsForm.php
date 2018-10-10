<?php

namespace modules\bulletin\common\types\forms;


use yii\base\Model;

class ItemsForm extends Model
{
  public $lang_id;

  public $val;

  public function rules()
  {
    return [
      [['lang_id'], 'integer'],
      [['val'], 'string'],
    ];
  }

  public function valToArray()
  {
    $list = $this->val;
    if(is_string($list)){
      $list = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $list)));
    }
    return $list;
  }

  public static function createFromArray($langId, $valArr)
  {
    $params = ['lang_id' => $langId];
    $valStr = '';
    foreach($valArr as $val) {
      $valStr .= $val . PHP_EOL;
    }
    $params['val'] = $valStr;
    return new self($params);
  }
}
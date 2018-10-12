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
      [['val'], 'required'],
      [['val'], 'validateValArray'],
    ];
  }

  public $arrayCount;

  public function validateValArray($attribute, $params)
  {
    if(is_numeric($this->arrayCount) && count($this->valToArray()) != $this->arrayCount) {
      $this->addError($attribute, 'Варианты различаются количественно');
    }
  }

  public function attributeLabels()
  {
    return [
      'val' => 'Варианты'
    ];
  }

  public function attributeHints()
  {
    return [
      'val' => 'Введите каждый вариант выбора c новой строки.'
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

  public function isEmpty()
  {
    return count(array_filter($this->attributes)) <= 1;
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
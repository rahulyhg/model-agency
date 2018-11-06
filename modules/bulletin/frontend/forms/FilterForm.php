<?php

namespace modules\bulletin\frontend\forms;

use modules\bulletin\common\models\Attribute;
use modules\bulletin\common\models\AttributeType;
use modules\bulletin\common\models\AttributeVal;
use modules\bulletin\common\models\Bulletin;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\helpers\StringHelper;

class FilterForm extends Model
{
  public $priceFrom;
  public $priceTo;
  public $floorFrom;
  public $floorTo;
  public $withCommission;
  public $bathroom;
  public $communications;

  CONST PRICE = 27;
  CONST FLOOR = 26;
  CONST WITH_COMMISSION = 24;
  CONST BATHROOM = 28;
  CONST COMMUNICATION = 25;

  CONST POSTS_PER_PAGE = 7;

  public function formName()
  {
    return 'search';
  }

  public function rules()
  {
    return [
      ['price', 'safe'],
      [['priceFrom', 'priceTo'], 'integer'],
      [['floorFrom', 'floorTo'], 'integer'],
      ['withCommission', 'boolean'],
      ['bathroom', 'in', 'range' => array_keys($this->bathroomVariants())],
      ['communications', 'each', 'rule' => ['in', 'range' => array_keys($this->communicationsVariants())]],
    ];
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

    if (!$this->load($params) || !$this->validate()) {
      return $dataProvider;
    }

    $counter = 1;

    if (!empty($this->priceFrom) && !empty($this->priceTo)) {
      $query->joinWith("attributeVals av$counter");
      $query->andFilterWhere(["and", ["av$counter.attribute_id" => self::PRICE], ["between", "av$counter.val", intval($this->priceFrom), intval($this->priceTo)]]);
      $counter++;
    } elseif (!empty($this->priceFrom)) {
      $query->joinWith("attributeVals av$counter");
      $query->andFilterWhere(["and", ["av$counter.attribute_id" => self::PRICE], [">=", "av$counter.val", intval($this->priceFrom)]]);
      $counter++;
    } elseif (!empty($this->priceTo)) {
      $query->joinWith("attributeVals av$counter");
      $query->andFilterWhere(["and", ["av$counter.attribute_id" => self::PRICE], ["<=", "av$counter.val", intval($this->priceTo)]]);
      $counter++;
    }

    if (!empty($this->floorFrom) && !empty($this->floorTo)) {
      $query->joinWith("attributeVals av$counter");
      $query->andFilterWhere(["and", ["av$counter.attribute_id" => self::FLOOR], ["between", "av$counter.val", intval($this->floorFrom), intval($this->floorTo)]]);
      $counter++;
    } elseif (!empty($this->floorFrom)) {
      $query->joinWith("attributeVals av$counter");
      $query->andFilterWhere(["and", ["av$counter.attribute_id" => self::FLOOR], [">=", "av$counter.val", intval($this->floorFrom)]]);
      $counter++;
    } elseif (!empty($this->floorTo)) {
      $query->joinWith("attributeVals av$counter");
      $query->andFilterWhere(["and", ["av$counter.attribute_id" => self::FLOOR], ["<=", "av$counter.val", intval($this->floorTo)]]);
      $counter++;
    }

    if (!empty($this->withCommission)) {
      $query->joinWith("attributeVals av$counter");
      $query->andFilterWhere(["and", ["av$counter.attribute_id" => self::WITH_COMMISSION], ["av$counter.val" => $this->withCommission]]);
      $counter++;
    }

    if (!$this->isNullOrEmptyString($this->bathroom)) {
      $query->joinWith("attributeVals av$counter");
      $query->andFilterWhere(["and", ["av$counter.attribute_id" => self::BATHROOM], ["av$counter.val" => $this->bathroom]]);
      $counter++;
    }
    if (!empty($this->communications)) {
      $query->joinWith("attributeVals av$counter");
      $query->andFilterWhere(["and", ["av$counter.attribute_id" => self::COMMUNICATION], "json_contains(av$counter.val, '" . Json::encode($this->communications) . "') = 1"]);
      $counter++;
    }

    return $dataProvider;
  }

  protected function isNullOrEmptyString($str)
  {
    return (!isset($str) || trim($str) === '');
  }

  public function bathroomVariants()
  {
    return [
      'Смежный',
      'Раздельный',
    ];
  }

  public function communicationsVariants()
  {
    return [
      'Газ',
      'Электричество',
      'Вывоз отходов',
    ];
  }
}
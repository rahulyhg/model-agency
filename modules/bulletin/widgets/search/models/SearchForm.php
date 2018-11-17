<?php
/**
 * Created by PhpStorm.
 * User: TOTONIS
 * Date: 17.11.2018
 * Time: 13:02
 */

namespace modules\bulletin\widgets\search\models;


use modules\bulletin\common\models\Bulletin;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SearchForm extends Bulletin
{
  public $query;

  public function rules()
  {
    return [
      ['query', 'string', 'max' => 255]
    ];
  }

  public function scenarios()
  {
    return Model::scenarios();
  }

  /**
   * Creates data provider instance with search query applied
   *
   * @param array $params
   *
   * @return ActiveDataProvider
   */
  public function search($params)
  {
    $query = Bulletin::find();


    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    $this->load($params);

    if (!$this->validate()) {
      return $dataProvider;
    }

    if (isset($this->query)) {
      $query->andFilterWhere([
        'OR',
        ['LIKE', 'title', $this->query],
        ['LIKE', 'content', $this->query],
      ]);
    }


    return $dataProvider;
  }
}
<?php

namespace modules\mod\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\mod\common\models\Mod;

/**
 * ModSearch represents the model behind the search form about `modules\mod\common\models\Mod`.
 */
class ModSearch extends Mod
{
  public $full_name;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['bust', 'waist', 'hips', 'eyes_color_id', 'hair_color_id', 'shoes'], 'integer'],
      [['full_name'], 'safe'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function scenarios()
  {
    // bypass scenarios() implementation in the parent class
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
    $query = Mod::find();

    // add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    if (!$this->load($params) || !$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    // grid filtering conditions
    $query->andFilterWhere([
      'bust' => $this->bust,
      'waist' => $this->waist,
      'hips' => $this->hips,
      'eyes_color_id' => $this->eyes_color_id,
      'hair_color_id' => $this->hair_color_id,
      'shoes' => $this->shoes,
//          'phone_number',
//          'email',
//          'country',
//          'age',
    ]);

    $query->andFilterWhere(['like', 'first_name', $this->first_name])
      ->andFilterWhere(['like', 'middle_name', $this->middle_name])
      ->andFilterWhere(['like', 'last_name', $this->last_name]);

    return $dataProvider;
  }
}

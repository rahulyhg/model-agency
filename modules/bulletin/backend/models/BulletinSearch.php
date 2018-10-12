<?php

namespace modules\bulletin\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\bulletin\common\models\Bulletin;

/**
 * BulletinSearch represents the model behind the search form of `modules\bulletin\common\models\Bulletin`.
 */
class BulletinSearch extends Bulletin
{
  public $client;

  public $createdAt;
  public $createdAtStart;
  public $createdAtEnd;

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'location_id', 'client_id', 'category_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
      [['title', 'content'], 'safe'],
      [['client'], 'safe'],
      [['createdAt', 'createdAtStart', 'createdAtEnd'], 'safe'],
    ];
  }

  /**
   * {@inheritdoc}
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
    $query = Bulletin::find()->alias('b')->joinWith(['client c']);

// add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    $dataProvider->sort->attributes['client'] = [
      'asc' => ['client_id' => SORT_ASC],
      'desc' => ['client_id' => SORT_DESC],
    ];

    $this->load($params);

    if (!$this->validate()) {
// uncomment the following line if you do not want to return any records when validation fails
// $query->where('0=1');
      return $dataProvider;
    }

    if(!empty($this->client)) {
      $query->andWhere(['like', "CONCAT('#', c.id, ' - ', c.phone)", $this->client]);
    }


// grid filtering conditions
    $query->andFilterWhere([
      'b.id' => $this->id,
      'b.category_id' => $this->category_id,
      'b.status_id' => $this->status_id,
      'b.created_at' => $this->created_at,
      'b.updated_at' => $this->updated_at,
    ]);

    $query->andFilterWhere(['like', 'b.title', $this->title]);


    return $dataProvider;
  }
}
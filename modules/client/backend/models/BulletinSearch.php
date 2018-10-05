<?php

namespace modules\client\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\bulletin\common\models\Bulletin;

/**
* BulletinSearch represents the model behind the search form of `modules\bulletin\common\models\Bulletin`.
*/
class BulletinSearch extends Bulletin
{
/**
* {@inheritdoc}
*/
public function rules()
{
return [
[['id', 'location_id', 'client_id', 'category_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content'], 'safe'],
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
$query = Bulletin::find();

// add conditions that should always apply here

$dataProvider = new ActiveDataProvider([
'query' => $query,
]);

$this->load($params);

if (!$this->validate()) {
// uncomment the following line if you do not want to return any records when validation fails
// $query->where('0=1');
return $dataProvider;
}

// grid filtering conditions
$query->andFilterWhere([
            'id' => $this->id,
            'location_id' => $this->location_id,
            'client_id' => $this->client_id,
            'category_id' => $this->category_id,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

return $dataProvider;
}
}
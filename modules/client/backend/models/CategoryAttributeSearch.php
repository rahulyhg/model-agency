<?php

namespace modules\client\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\bulletin\common\models\CategoryAttribute;

/**
* CategoryAttributeSearch represents the model behind the search form of `modules\bulletin\common\models\CategoryAttribute`.
*/
class CategoryAttributeSearch extends CategoryAttribute
{
/**
* {@inheritdoc}
*/
public function rules()
{
return [
[['id', 'category_id', 'attribute_id', 'group_id', 'position'], 'integer'],
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
$query = CategoryAttribute::find();

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
            'category_id' => $this->category_id,
            'attribute_id' => $this->attribute_id,
            'group_id' => $this->group_id,
            'position' => $this->position,
        ]);

return $dataProvider;
}
}
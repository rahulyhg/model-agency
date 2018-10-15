<?php

namespace modules\bulletin\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\bulletin\common\models\Service;

/**
 * ServiceSearch represents the model behind the search form about `modules\bulletin\common\models\Service`.
 */
class ServiceSearch extends Service
{
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'duration'], 'integer'],
            [['price'], 'number'],
            [['name'], 'safe'],
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
        $query = Service::find()->alias('t')->joinWith('defaultTranslation dtr');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['name'] = [
          'asc' => ['dtr.name' => SORT_ASC],
          'desc' => ['dtr.name' => SORT_DESC],
        ];

        if (!$this->load($params) || !$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            't.id' => $this->id,
            't.duration' => $this->duration,
            't.price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'dtr.name', $this->name]);

        return $dataProvider;
    }
}

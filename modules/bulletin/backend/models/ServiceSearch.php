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
    public $entity_id;
    public $name;
    public $description;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'duration', 'created_at', 'updated_at', 'id', 'entity_id', 'lang_id'], 'integer'],
            [['price'], 'number'],
            [['name', 'description'], 'safe'],
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
        $query = Service::find()->joinWith('defaultTranslation');

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
            'id' => $this->id,
            'duration' => $this->duration,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'entity_id' => $this->entity_id,
            'lang_id' => $this->lang_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}

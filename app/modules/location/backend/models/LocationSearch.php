<?php

namespace modules\location\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\location\common\models\Location;

/**
 * LocationSearch represents the model behind the search form about `modules\location\common\models\Location`.
 */
class LocationSearch extends Location
{
    public $entity_id;
    public $name;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id', 'entity_id', 'lang_id'], 'integer'],
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
        $query = Location::find()->joinWith('defaultTranslation');

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
            'entity_id' => $this->entity_id,
            'lang_id' => $this->lang_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}

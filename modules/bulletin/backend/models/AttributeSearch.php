<?php

namespace modules\bulletin\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\bulletin\common\models\Attribute;

/**
 * AttributeSearch represents the model behind the search form about `modules\bulletin\common\models\Attribute`.
 */
class AttributeSearch extends Attribute
{
    public $entity_id;
    public $name;
    public $tr_type_settings;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'created_at', 'updated_at', 'id', 'entity_id', 'lang_id'], 'integer'],
            [['type_settings', 'name', 'tr_type_settings'], 'safe'],
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
        $query = Attribute::find()->joinWith('defaultTranslation');

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
            'type_id' => $this->type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'entity_id' => $this->entity_id,
            'lang_id' => $this->lang_id,
        ]);

        $query->andFilterWhere(['like', 'type_settings', $this->type_settings])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tr_type_settings', $this->tr_type_settings]);

        return $dataProvider;
    }
}

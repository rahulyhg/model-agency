<?php

namespace modules\bulletin\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\bulletin\common\models\CategoryAttributeGroup;

/**
 * CategoryAttributeGroupSearch represents the model behind the search form about `modules\bulletin\common\models\CategoryAttributeGroup`.
 */
class CategoryAttributeGroupSearch extends CategoryAttributeGroup
{
    public $entity_id;
    public $name;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'created_at', 'updated_at', 'uid', 'id', 'entity_id', 'lang_id'], 'integer'],
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
        $query = CategoryAttributeGroup::find()->joinWith('defaultTranslation');

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
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'uid' => $this->uid,
            'entity_id' => $this->entity_id,
            'lang_id' => $this->lang_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}

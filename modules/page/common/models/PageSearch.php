<?php

namespace modules\page\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\page\common\models\Page;

/**
 * PageSearch represents the model behind the search form about `\modules\page\common\models\Page`.
 */
class PageSearch extends Page
{
    public $entity_id;
    public $title;
    public $content;
    public $seo_title;
    public $seo_description;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'thumb_id', 'created_at', 'updated_at', 'id', 'lang_id', 'entity_id'], 'integer'],
            [['slug', 'title', 'content', 'seo_title', 'seo_description'], 'safe'],
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
        $query = Page::find()->joinWith('defaultTranslation');

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
            'thumb_id' => $this->thumb_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'lang_id' => $this->lang_id,
            'entity_id' => $this->entity_id,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description]);

        return $dataProvider;
    }
}

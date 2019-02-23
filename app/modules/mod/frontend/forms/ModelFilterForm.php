<?php
namespace modules\mod\frontend\forms;

use modules\mod\common\models\HairColor;
use modules\mod\common\models\Mod;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ModelFilterForm extends Model
{
  public $age_from;
  public $age_to;
  public $height_from;
  public $height_to;
  public $weight_from;
  public $weight_to;
  public $full_name;
  public $hair_color_id;

  public $orderBy = 'created_at';

  public static function getOrderMap()
  {
    return [
      'created_at' => 'Новизне',
      'rating' => 'Рейтингу',
    ];
  }

  public function rules()
  {
    return [
      [['age_from', 'age_to', 'height_from', 'height_to', 'weight_from', 'weight_to', 'hair_color_id'], 'integer'],
      [['full_name'], 'string'],
      [['hair_color_id'], 'exist', 'targetClass' => HairColor::class, 'targetAttribute' => ['hair_color_id' => 'id']],

      [['orderBy'], 'string']
    ];
  }

  public function attributeLabels()
  {
    return [
      'age_from' => 'Возраст от',
      'age_to' => 'Возраст до',
      'height_from' => 'Рост от',
      'height_to' => 'Рост до',
      'weight_from' => 'Вес от',
      'weight_to' => 'Вес до',
      'fullname' => 'Имя'
    ];
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
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);
    if (!$this->load($params) || !$this->validate()) {
      return $dataProvider;
    }
    $query->andFilterWhere(['>=', 'age', $this->age_from]);
    $query->andFilterWhere(['<=', 'age', $this->age_to]);

    $query->andFilterWhere(['>=', 'height', $this->height_from]);
    $query->andFilterWhere(['<=', 'height', $this->height_to]);

    $query->andFilterWhere(['>=', 'weight', $this->weight_from]);
    $query->andFilterWhere(['<=', 'weight', $this->weight_to]);

    $query->andFilterWhere(['LIKE', 'full_name', $this->full_name]);

    $query->andFilterWhere(['=', 'hair_color_id', $this->hair_color_id]);

    if( $this->orderBy === 'created_at' ) {
      $query->orderBy('created_at DESC');
    }

    return $dataProvider;
  }
}
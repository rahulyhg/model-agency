<?php

namespace modules\bulletin\common\models;

use Yii;

/**
 * This is the model class for table "{{%bulletin_stat}}".
 *
 * @property int $id
 * @property int $bulletin_id
 * @property int $views
 * @property int $phoneViews
 *
 * @property Bulletin $bulletin
 */
class BulletinStat extends \common\lib\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bulletin_stat}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bulletin_id'], 'required'],
            [['bulletin_id', 'views', 'phoneViews'], 'integer'],
            [['bulletin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bulletin::class, 'targetAttribute' => ['bulletin_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bulletin_id' => 'Объявление',
            'views' => 'Количество просмотров',
            'phoneViews' => 'Просмотров телефона',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBulletin()
    {
        return $this->hasOne(Bulletin::class, ['id' => 'bulletin_id']);
    }
}

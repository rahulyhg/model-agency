<?php

namespace modules\block\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%block}}".
 *
 * @property int $id
 * @property string $key
 * @property string $content
 * @property string $description
 * @property string $css
 * @property string $js
 * @property int $created_at
 * @property int $updated_at
 */
class Block extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return ArrayHelper::merge( parent::behaviors(), [
            TimestampBehavior::class,
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%block}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['content', 'description', 'css', 'js'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['key'], 'string', 'max' => 255],
            ['key', 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'content' => 'Content',
            'description' => 'Description',
            'css' => 'Css',
            'js' => 'Js',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

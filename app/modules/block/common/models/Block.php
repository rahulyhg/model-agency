<?php

namespace modules\block\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use modules\block\Module;

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
            'id' => Module::t('attributeLabels', 'id'),
            'key' => Module::t('attributeLabels', 'key'),
            'content' => Module::t('attributeLabels', 'content'),
            'description' => Module::t('attributeLabels', 'description'),
            'css' => Module::t('attributeLabels', 'css'),
            'js' => Module::t('attributeLabels', 'js'),
            'created_at' => Module::t('attributeLabels', 'created_at'),
            'updated_at' => Module::t('attributeLabels', 'updated_at'),
        ];
    }
}

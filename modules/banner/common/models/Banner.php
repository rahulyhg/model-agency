<?php

namespace modules\banner\common\models;

use modules\banner\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property int $id
 * @property string $position
 * @property string $text
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 */
class Banner extends \yii\db\ActiveRecord
{
  public function behaviors()
  {
    return ArrayHelper::merge(parent::behaviors(), [
      TimestampBehavior::class,
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%banner}}';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['position'], 'required'],
      [['name', 'position'], 'string', 'max' => 255],
      [['created_at', 'updated_at'], 'integer'],
      ['text', 'safe'],
      ['position', 'unique'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => Module::t('attributeLabels', 'id'),
      'name' => Module::t('attributeLabels', 'name'),
      'text' => Module::t('attributeLabels', 'text'),
      'position' => Module::t('attributeLabels', 'position'),
      'created_at' => Module::t('attributeLabels', 'created_at'),
      'updated_at' => Module::t('attributeLabels', 'updated_at'),
    ];
  }
}

<?php

namespace modules\mod\common\models;

use Yii;
use modules\lang\common\models\Lang;

/**
 * This is the model class for table "{{%hair_color_lang}}".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $lang_id
 * @property string $color
 *
 * @property HairColor $entity
 */
class HairColorLang extends \modules\lang\lib\LangActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%hair_color_lang}}';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['entity_id', 'lang_id'], 'integer'],
      [['color'], 'string', 'max' => 15],
      [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => HairColor::class, 'targetAttribute' => ['entity_id' => 'id']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'entity_id' => 'Entity ID',
      'lang_id' => 'Lang ID',
      'color' => 'Color',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getEntity()
  {
    return $this->hasOne(HairColor::class, ['id' => 'entity_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLang()
  {
    return $this->hasOne(Lang::class, ['id' => 'lang_id']);
  }
}

<?php

namespace modules\mod\common\models;

use Yii;

/**
 * This is the model class for table "{{%spoken_lang}}".
 *
 * @property integer $id
 *
 * @property SpokenLangLang[] $translations
 * @property ModSpokenLang[] $modSpokenLangs
 *
 * from lang model
 * @property string $name
 */
class SpokenLang extends \modules\lang\lib\TranslatableActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%spoken_lang}}';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTranslations()
  {
    return $this->hasMany(SpokenLangLang::class, ['entity_id' => 'id']);
  }

  protected static $_map;

  public static function getMap()
  {
    if (!isset(self::$_map)) {
      self::$_map = \yii\helpers\ArrayHelper::map(
        self::find()
          ->joinWith('translations tr')
          ->orderBy('tr.name')
          ->all(), 'id', 'name'
      );
    }
    return self::$_map;
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getModSpokenLangs()
  {
    return $this->hasMany(ModSpokenLang::class, ['lang_id' => 'id']);
  }
}

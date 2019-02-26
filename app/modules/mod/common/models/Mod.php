<?php

namespace modules\mod\common\models;

use common\lib\ActiveRecord;
use modules\mod\common\models\ModImage;
use modules\mod\common\services\ModService;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%mod}}".
 *
 * @property integer $id
 * @property integer $bust
 * @property integer $waist
 * @property integer $hips
 * @property integer $eyes_color_id
 * @property integer $hair_color_id
 * @property integer $shoes
 * @property integer $country_id
 * @property integer $age
 * @property integer $height
 * @property integer $weight
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $mod_user_id
 * @property string $images_order_json
 * @property string full_name
 *
 * @property EyesColor $eyesColor
 * @property HairColor $hairColor
 * @property ModUser $modUser
 * @property ModLang[] $translations
 * @property ModImage[] $modImages
 * @property ModSpokenLang[] $modSpokenLangs
 *
 * @property array $spoken_lang_ids
 * @property Mod $nextMod
 * @property Mod $prevMod
 */
class Mod extends ActiveRecord
{
  public $spoken_lang_ids;
  public $deleted_spoken_lang_ids;

  public static function getBustSizeMap()
  {
    return [
      1 => 1,
      2 => 2,
      3 => 3,
      4 => 4,
      5 => 5,
      6 => 6,
    ];
  }

  /**
   * @var $images
   */
  public $images;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%mod}}';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    /**
     * рост от 100 до 250 см
     * вес 35 - 150
     * размер груди а не бюст. от 0 до 6 может быть.
     * талия в см. от 40 до 150 см
     * бедра в см. от 40 до 200 см
     * цвета самому найти
     * в языки добавить всевозможные языки мира
     */
    return [
      [['age', 'mod_user_id', 'weight', 'height', 'full_name'], 'required'],
      [['bust', 'waist', 'hips', 'eyes_color_id', 'hair_color_id', 'shoes', 'age', 'country_id', 'mod_user_id', 'created_at', 'updated_at', 'weight', 'height'], 'integer'],
      [['images_order_json'], 'string'],
      [['full_name'], 'string', 'max' => 255],
      [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png', 'maxFiles' => 10],
      [['eyes_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => EyesColor::class, 'targetAttribute' => ['eyes_color_id' => 'id']],
      [['hair_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => HairColor::class, 'targetAttribute' => ['hair_color_id' => 'id']],
      [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::class, 'targetAttribute' => ['country_id' => 'id']],
      [['spoken_lang_ids'], 'each', 'rule' => ['integer']],
      [['deleted_spoken_lang_ids'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'bust' => 'Размер груди',
      'waist' => 'Обхват талии (см)',
      'hips' => 'Обхват бедер (см)',
      'age' => 'Возраст',
      'weight' => 'Вес (кг)',
      'height' => 'Рост (см)',
      'country_id' => 'Страна',
      'eyes_color_id' => 'Цвет глаз',
      'hair_color_id' => 'Цвет волос',
      'shoes' => 'Размер обуви',
      'created_at' => 'Дата создания',
      'updated_at' => 'Дата последнего обновления',
      'full_name' => 'Имя',
    ];
  }

  public function afterFind()
  {
    $this->spoken_lang_ids = [];
    $modSpokenLangs = ModSpokenLang::find()->where(['mod_id' => $this->id])->all();
    if($modSpokenLangs) {
      foreach ($modSpokenLangs as $modSpokenLang) {
        $this->spoken_lang_ids[] = $modSpokenLang->spoken_lang_id;
      }
    }
    parent::afterFind();
  }

  public function beforeDelete()
  {
    // delete mod user before mod delete
    if($this->modUser->delete()) {
      if($this->modSpokenLangs) {
        foreach ($this->modSpokenLangs as $modSpokenLang) {
          $modSpokenLang->delete();
        }
      }
      return parent::beforeDelete();
    }
  }

  public function beforeSave($insert)
  {
    // delete deleted :D
    if($this->deleted_spoken_lang_ids) {
      $deleted_spoken_lang_ids = explode(',', $this->deleted_spoken_lang_ids);
      foreach ($deleted_spoken_lang_ids as $deleted_spoken_lang_id) {
        $toDeleteMSL = ModSpokenLang::findOne(['mod_id' => $this->id, 'spoken_lang_id' => intval($deleted_spoken_lang_id)]);
        if($toDeleteMSL) {
          $toDeleteMSL->delete();
        }
      }
    }
    // save new
    foreach ($this->spoken_lang_ids as $spoken_lang_id) {
      $exist = ModSpokenLang::findOne(['mod_id' => $this->id, 'spoken_lang_id' => intval($spoken_lang_id)]);
      if(!$exist) {
        $modSpokenLang = new ModSpokenLang([
          'mod_id' => $this->id,
          'spoken_lang_id' => intval($spoken_lang_id)
        ]);
        $modSpokenLang->save();
      }
    }
    return parent::beforeSave($insert);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getModImages()
  {
    return $this->hasMany(ModImage::class, ['entity_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getModSpokenLangs()
  {
    return $this->hasMany(ModSpokenLang::class, ['mod_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getModUser()
  {
    return $this->hasOne(ModUser::class, ['id' => 'mod_user_id']);
  }

  /**
   * returns id of eyes color
   * @return \yii\db\ActiveQuery
   */
  public function getEyesColor()
  {
    return $this->hasOne(EyesColor::class, ['id' => 'eyes_color_id']);
  }

  /**
   * returns id of hair color
   * @return \yii\db\ActiveQuery
   */
  public function getHairColor()
  {
    return $this->hasOne(HairColor::class, ['id' => 'hair_color_id']);
  }

  /**
   * @return array of images ids
   */
  public function getImagesIds()
  {
    $modImages = ModImage::find()->where(['entity_id' => $this->id])->all();
    $imageIds = [];
    foreach ($modImages as $modImage) {
      /**
       * @var $modImage ModImage
       */
      $imageIds[] = $modImage->image_id;
    }

    return $imageIds;

//    return $this->hasMany(ModImage::class, ['id' => 'imagesIds']);
  }

  protected static $_map;

  public static function getMap()
  {
    if (!isset(self::$_map)) {
      self::$_map = \yii\helpers\ArrayHelper::map(
        self::find()
          ->joinWith('translations tr')
          ->orderBy('tr.first_name')
          ->all(), 'id', 'first_name'
      );
    }
    return self::$_map;
  }

  const IMAGES_DIR = 'models/images';

  public function upload()
  {
    $this->images = UploadedFile::getInstances($this, 'images');
    if ($this->validate('images')) {
      if (empty($this->images)) {
        return true;
      }

      if ($imagesIds = Yii::$app->filestorage->multipleUploadFromModel($this, 'images', self::IMAGES_DIR)) {
        $modImagesData = ModService::generateModImageObjects($imagesIds, $this->id);
        $this->save(true, ['images_order_json']);
        $this->populateRelation('modImages', $modImagesData['modImages']);
        return true;
      }
    }

    return false;
  }

  public function uploadOnePhoto()
  {
    $this->images = UploadedFile::getInstances($this, 'images');
    if ($this->validate('images')) {
      if (count($this->images) === 0) {
        return false;
      }
      if ($imagesIds = Yii::$app->filestorage->multipleUploadFromModel($this, 'images', self::IMAGES_DIR)) {
        $modImagesData = ModService::generateModImageObjects($imagesIds, $this->id);
        $this->populateRelation('modImages', $modImagesData['modImages']);
        return true;
      }
    }
    return false;
  }

  public function getNextMod()
  {
    $nextMod = $this->find()->where(['>', 'id', $this->id])->orderBy('id ASC')->one();
    if(!$nextMod) return null;
    return $nextMod;
  }

  public function getPrevMod()
  {
    $prevMod = $this->find()->where(['<', 'id', $this->id])->orderBy('id DESC')->one();
    if(!$prevMod) return null;
    return $prevMod;
  }
}

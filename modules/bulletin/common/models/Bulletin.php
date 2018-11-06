<?php

namespace modules\bulletin\common\models;

use common\models\DynamicModel;
use DateTime;
use modules\client\common\models\Client;
use modules\location\common\models\Location;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "{{%bulletin}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $location_id
 * @property int $client_id
 * @property int $category_id
 * @property int $status_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AttributeVal[] $attributeVals
 * @property Category $category
 * @property Client $client
 * @property Location $location
 * @property BulletinImage[] $bulletinImages
 * @property Complaint[] $complaints
 * @property ServiceBulletin[] $serviceBulletins
 *
 * @property string $thumbnailUrl
 * @property mixed $formattedCreatedAt
 * @property mixed $price
 */
class Bulletin extends \common\lib\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%bulletin}}';
  }

  protected static $_map;

  public static function getMap()
  {
    if (!isset(self::$_map))
      self::$_map = ArrayHelper::map(self::find()->orderBy('id')->all(), 'id', 'shortTitle');
    return self::$_map;
  }

  public function getShortTitle()
  {
    return "#" . $this->id . " " . StringHelper::truncateWords($this->title, 3);
  }

  public function getMaxFilesLeft()
  {
    return BulletinImage::MAX_FILES - count($this->bulletinImages);
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['title', 'content', 'location_id', 'client_id', 'category_id', 'status_id'], 'required'],
      [['content'], 'string', 'max' => 9000],
      ['status_id', 'default', 'value' => 1],
      [['location_id', 'client_id', 'category_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
      [['title'], 'string', 'max' => 255],
      [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
      [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
      [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location_id' => 'id']],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'title' => 'Заголовок',
      'content' => 'Содержание',
      'location_id' => 'Место положения',
      'client_id' => 'Пользователь',
      'client' => 'Пользователь',
      'category_id' => 'Категория',
      'status_id' => 'Статус',
      'created_at' => 'Дата создания',
      'updated_at' => 'Дата последнего обновления',
    ];
  }

  protected $_price;
  public function getPrice()
  {
    if(isset($this->_price))
      return $this->_price;
    $attributeVal = AttributeVal::find()->alias('av')
      ->joinWith(['attribute0 a'])
      ->where(['av.entity_id' => $this->id, 'a.type_id' => AttributeType::MONEY])
      ->one();
    if($attributeVal)
      return $this->_price = $attributeVal->val;
    return $this->_price = false;
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getAttributeVals()
  {
    return $this->hasMany(AttributeVal::className(), ['entity_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCategory()
  {
    return $this->hasOne(Category::className(), ['id' => 'category_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getStatus()
  {
    return $this->hasOne(BulletinStatus::className(), ['id' => 'status_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getClient()
  {
    return $this->hasOne(Client::className(), ['id' => 'client_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLocation()
  {
    return $this->hasOne(Location::className(), ['id' => 'location_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getBulletinImages()
  {
    return $this->hasMany(BulletinImage::className(), ['entity_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getComplaints()
  {
    return $this->hasMany(Complaint::className(), ['entity_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getServiceBulletins()
  {
    return $this->hasMany(ServiceBulletin::className(), ['entity_id' => 'id']);
  }

  protected $_images = [];

  public function addImages($value)
  {
    $this->_images = ArrayHelper::merge($this->_images, $value);
  }

  public function getImages()
  {

  }

  public function getThumbnailUrl()
  {
    if(!empty($this->bulletinImages)){
      return $this->bulletinImages[0]->getImageUrl();
    }
    return null;
  }

  public function getFormattedCreatedAt()
  {
    $today = new DateTime(date('Y-m-d'));
    $yesterday = new DateTime(date('Y-m-d', strtotime('-1 days')));
    $createdAt = new DateTime('@'.$this->created_at);
    if($createdAt >= $today) {
      return 'Сегодня' . ' ' . date('h:i', $this->created_at);
    }
    if($createdAt >= $yesterday) {
      return 'Вчера' . ' ' . date('h:i', $this->created_at);
    }
    return Yii::$app->formatter->asDate($this->created_at, 'php:d M');
  }

//  public function load($data, $formName = null)
//  {
//    parent::load($data, $formName);
//    $models = DynamicModel::createMultiple(
//      BulletinImage::class,
//      empty($this->bulletinImages) ? [] : $this->bulletinImages,
//      $data
//    );
//    $flag = true;
//    if (!empty($models)) {
//      DynamicModel::loadMultiple($models, $data);
//      foreach($models as $i => $model) {
//        if(!$model->uploadFile($i)) {
//          $flag = false;
//        }
//      }
//    }
//    $this->populateRelation('documentDatas', $models);
//    return $flag;
//  }

  public function beforeValidate()
  {
    if (parent::beforeValidate()) {
      return self::validateMultiple($this->attributeVals);
    }
    return false;
  }

//  public function validate($attributeNames = null, $clearErrors = true)
//  {
//    return parent::validate($attributeNames, $clearErrors) &&
//    DynamicModel::validateMultiple($this->bulletinImages);
//  }

  public function save($runValidation = true, $attributeNames = null)
  {
    $db = $this->getDb();
    $tr = $db->beginTransaction();
    try {
      $attributeVals = $this->attributeVals;
      $bulletinImages = $this->bulletinImages;
      if (parent::save($runValidation, $attributeNames)) {
        //images
        if (is_array($bulletinImages)) {
          $notDeletedImageIds = [];
          foreach ($bulletinImages as $imgInd => $bulletinImage) {
            $bulletinImage->entity_id = $this->id;
            $bulletinImage->position = $imgInd;
            if (!$bulletinImage->save(false)) {
              $tr->rollBack();
              return false;
            }
//            $notDeletedImageIds[] = $bulletinImage->id;
          }
          /*if (!$this->isNewRecord) {
            $deleteModels = BulletinImage::find()
              ->andWhere(['not in', 'id', $notDeletedImageIds])
              ->andWhere(['entity_id' => $this->id])
              ->all();
            foreach ($deleteModels as $deleteModel) {
              $deleteModel->delete();
            }
          }/**/
        }
        //attributeVals
        if (is_array($attributeVals)) {
          $notDeletedIds = [];
          foreach ($attributeVals as $index => $attributeVal) {
            $attributeVal->entity_id = $this->id;
            if (!$attributeVal->save(false)) {
              $tr->rollBack();
              return false;
            }
            $notDeletedIds[] = $attributeVal->id;
          }
          if (!$this->isNewRecord) {
            AttributeVal::deleteAll(
              ['and', ['not in', 'id', $notDeletedIds], ['entity_id' => $this->id]]
            );
          }
        }
        $tr->commit();
        return true;
      }
    } catch (Exception $ex) {
      $tr->rollBack();
    }
    return false;
  }
}

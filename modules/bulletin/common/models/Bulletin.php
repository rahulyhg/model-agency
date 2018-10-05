<?php

namespace modules\bulletin\common\models;

use modules\client\common\models\Client;
use modules\location\common\models\Location;
use Yii;
use yii\db\Exception;

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'location_id', 'client_id', 'category_id', 'status_id'], 'required'],
            [['content'], 'string'],
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
            'title' => 'Title',
            'content' => 'Content',
            'location_id' => 'Location ID',
            'client_id' => 'Client ID',
            'category_id' => 'Category ID',
            'status_id' => 'Status ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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

    public function beforeValidate()
    {
        if(parent::beforeValidate()) {
            return self::validateMultiple($this->attributeVals);
        }
        return false;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $db = $this->getDb();
        $tr = $db->beginTransaction();
        try {
            $attributeVals = $this->attributeVals;
            if (parent::save($runValidation, $attributeNames)) {
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
                $tr->commit();
                return true;
            }
        } catch (Exception $ex) {
            $tr->rollBack();
        }
        return false;
    }
}

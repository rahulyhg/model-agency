<?php

namespace modules\client\common\models;

use modules\bulletin\common\models\Bulletin;
use modules\location\common\models\Location;
use Yii;

/**
 * This is the model class for table "{{%client}}".
 *
 * @property int $id
 * @property int $avatar_id
 * @property string $email
 * @property string $phone
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $location_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Bulletin[] $bulletins
 * @property Location $location
 */
class Client extends \common\lib\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%client}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avatar_id', 'location_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['email', 'phone', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['email', 'phone', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'avatar_id' => 'Avatar ID',
            'email' => 'Email',
            'phone' => 'Телефон',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'location_id' => 'Место положения',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBulletins()
    {
        return $this->hasMany(Bulletin::class, ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::class, ['id' => 'location_id']);
    }

    public function getTitle()
    {
        return "#".$this->id." - ".$this->phone;
    }

    protected static $_map;

    public static function getMap()
    {
        if(!isset(self::$_map)) {
            self::$_map = \yii\helpers\ArrayHelper::map(
                self::find()
                  ->orderBy('phone')
                  ->all(), 'id', 'title'
            );
        }
        return self::$_map;
    }
}

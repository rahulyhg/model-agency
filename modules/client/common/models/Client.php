<?php

namespace modules\client\common\models;

use common\behaviors\UploadFileBehavior;
use modules\bulletin\common\models\Bulletin;
use modules\location\common\models\Location;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%client}}".
 *
 * @property int $id
 * @property int $avatar_id
 * @property string $email
 * @property string $phone
 * @property string $auth_key
 * @property string $password_hash
 * @property string $name
 * @property string $password_reset_token
 * @property int $location_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Bulletin[] $bulletins
 * @property Location $location
 *
 * @property string $avatarUrl
 * @property string $avatarSize
 */
class Client extends \common\lib\ActiveRecord implements IdentityInterface
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 10;
  const AVATARS_DIR = 'client\avatar';

  public $newPassword;
  public $newPasswordRepeat;
  public $deleteAvatarFile = 0;
  public $avatarFile;

  private $avatarUrl;
  private $avatarSize;

  /**
   * @return null|string
   */
  public function getAvatarUrl()
  {
    if (!$this->avatarUrl) {
      $this->avatarUrl = Yii::$app->filestorage->getFileUrl($this->avatar_id);
      if (!$this->avatarUrl) {
        $this->avatarUrl = Yii::$app->setting->get('client', 'default_photo') ?: null;
      }
    }

    return $this->avatarUrl;
  }

  /**
   * @return int|string
   */
  public function getAvatarSize()
  {
    if (!$this->avatarSize) {
      $path = Yii::$app->filestorage->getFilePath($this->avatar_id);

      return $this->avatarSize = $path ? filesize($path) : 0;
    }

    return $this->avatarSize;
  }


  public function behaviors()
  {
    return [
      [
        'class' => UploadFileBehavior::class,
        'files' => [
          [
            'fileAttribute' => 'avatarFile',
            'idAttribute' => 'avatar_id',
            'deleteAttribute' => 'deleteAvatarFile',
          ],
        ],
        'directory' => self::AVATARS_DIR,
      ]
    ];
  }

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
      [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
      [['email', 'phone', 'name'], 'required'],
      [['email', 'phone', 'password_hash', 'name'], 'string', 'max' => 255],
      [['newPassword', 'newPasswordRepeat'], 'string', 'max' => 255, 'min' => 6],
      [['newPasswordRepeat'], 'compare', 'compareAttribute' => 'newPassword', 'message' => "Пароли не совпадают"],
      [['avatar_id', 'location_id', 'status', 'created_at', 'updated_at'], 'integer'],
      [['phone'], 'unique'],
      [['email'], 'unique'],
      [['email'], 'email'],
      [['deleteAvatarFile'], 'boolean'],
      [
        ['avatarFile'],
        'file',
        'maxSize' => 300000 /* 300 кб */,
        'skipOnEmpty' => true,
        'tooBig' => 'Это фото слишком большое. Максимальный размер: 300kb.',
        'extensions' => ['jpg', 'png', 'gif', 'jpeg'],
        'wrongExtension' => 'Не правильный формат фото. Разрешенные форматы: jpg, jpeg, png, gif.',
      ],
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
      'avatarFile' => 'Фото',
      'email' => 'Email',
      'phone' => 'Телефон',
      'auth_key' => 'Auth Key',
      'password_hash' => 'Password Hash',
      'password_reset_token' => 'Password Reset Token',
      'location_id' => 'Место положения',
      'status' => 'Статус',
      'created_at' => 'Дата создания',
      'updated_at' => 'Дата последнего обновления',
      'newPassword' => 'Новый пароль',
      'name' => 'Контактное лицо',
      'newPasswordRepeat' => 'Повторите пароль',
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
    return "#" . $this->id . " - " . $this->phone;
  }

  protected static $_map;

  public static function getMap()
  {
    if (!isset(self::$_map)) {
      self::$_map = \yii\helpers\ArrayHelper::map(
        self::find()
          ->orderBy('phone')
          ->all(), 'id', 'title'
      );
    }
    return self::$_map;
  }

  public function save($runValidation = true, $attributeNames = null)
  {
    if ($this->newPassword) {
      $this->password_hash = Yii::$app->security->generatePasswordHash($this->newPassword);
    }

    return parent::save($runValidation, $attributeNames);
  }


  /**
   * {@inheritdoc}
   */
  public static function findIdentity($id)
  {
    return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
  }

  /**
   * {@inheritdoc}
   */
  public static function findIdentityByAccessToken($token, $type = null)
  {
    throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
  }

  /**
   * Finds user by username
   *
   * @param string $phone
   *
   * @return static|null
   */
  public static function findByPhone($phone)
  {
    return static::findOne(['phone' => $phone, 'status' => self::STATUS_ACTIVE]);
  }

  /**
   * Finds user by password reset token
   *
   * @param string $token password reset token
   *
   * @return static|null
   */
  public static function findByPasswordResetToken($token)
  {
    if (!static::isPasswordResetTokenValid($token)) {
      return null;
    }

    return static::findOne([
      'password_reset_token' => $token,
      'status' => self::STATUS_ACTIVE,
    ]);
  }

  /**
   * Finds out if password reset token is valid
   *
   * @param string $token password reset token
   *
   * @return bool
   */
  public static function isPasswordResetTokenValid($token)
  {
    if (empty($token)) {
      return false;
    }

    $timestamp = (int)substr($token, strrpos($token, '_') + 1);
    $expire = Yii::$app->params['user.passwordResetTokenExpire'];

    return $timestamp + $expire >= time();
  }

  /**
   * {@inheritdoc}
   */
  public function getId()
  {
    return $this->getPrimaryKey();
  }

  /**
   * {@inheritdoc}
   */
  public function getAuthKey()
  {
    return $this->auth_key;
  }

  /**
   * {@inheritdoc}
   */
  public function validateAuthKey($authKey)
  {
    return $this->getAuthKey() === $authKey;
  }

  /**
   * Validates password
   *
   * @param string $password password to validate
   *
   * @return bool if password provided is valid for current user
   */
  public function validatePassword($password)
  {
    return Yii::$app->security->validatePassword($password, $this->password_hash);
  }

  /**
   * Generates password hash from password and sets it to the model
   *
   * @param string $password
   */
  public function setPassword($password)
  {
    $this->password_hash = Yii::$app->security->generatePasswordHash($password);
  }

  /**
   * Generates "remember me" authentication key
   */
  public function generateAuthKey()
  {
    $this->auth_key = Yii::$app->security->generateRandomString();
  }

  /**
   * Generates new password reset token
   */
  public function generatePasswordResetToken()
  {
    $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
  }

  /**
   * Removes password reset token
   */
  public function removePasswordResetToken()
  {
    $this->password_reset_token = null;
  }

}

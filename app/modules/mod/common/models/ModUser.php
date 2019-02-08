<?php

namespace modules\mod\common\models;

use common\behaviors\UploadFileBehavior;
use common\lib\ActiveRecord;
use Yii;
use yii\base\NotSupportedException;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%mod_user}}".
 *
 * @property int $id
 * @property string $email
 * @property string $phone
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $photo_id
 *
 * @property Mod $mod
 *
 * @property string $photoUrl
 */
class ModUser extends ActiveRecord implements IdentityInterface
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 10;
  const PHOTOS_DIR = 'models\avatar';

  public $newPassword;
  public $passwordRepeat;

  public $deletePhotoFile = 0;
  public $photoFile;

  private $photoUrl;
  private $photoSize;

  /**
   * @return null|string
   */
  public function getPhotoUrl() {
    if ( ! $this->photoUrl ) {
      $this->photoUrl = Yii::$app->filestorage->getFileUrl( $this->photo_id );
      if ( ! $this->photoUrl ) {
        $this->photoUrl = Yii::$app->setting->get( 'mode', 'model_default_photo' ) ?: null;
      }
    }

    return $this->photoUrl;
  }

  /**
   * @return int|string
   */
  public function getPhotoSize() {
    if ( ! $this->photoSize ) {
      $path = Yii::$app->filestorage->getFilePath( $this->photo_id );

      return $this->photoSize = $path ? filesize( $path ) : 0;
    }

    return $this->photoSize;
  }

  /**
   * @return array
   */
  public function behaviors() {
    return ArrayHelper::merge(parent::behaviors(), [
      [
        'class'     => UploadFileBehavior::class,
        'files'     => [
          [
            'fileAttribute'   => 'photoFile',
            'idAttribute'     => 'photo_id',
            'deleteAttribute' => 'deletePhotoFile',
          ],
        ],
        'directory' => self::PHOTOS_DIR,
      ]
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%mod_user}}';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['email', 'phone', 'auth_key', 'password_hash'], 'required'],
      [['status', 'created_at', 'updated_at', 'deletePhotoFile'], 'integer'],
      [['email', 'phone', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
      [['auth_key'], 'string', 'max' => 32],
      [['email'], 'unique'],
      [['phone'], 'unique'],
      [['password_reset_token'], 'unique'],

      [['newPassword', 'passwordRepeat'], 'string', 'min' => 6],
      ['passwordRepeat', 'compare', 'compareAttribute' => 'newPassword'],

      [ [ 'deletePhotoFile' ], 'boolean' ],
      [
        [ 'photoFile' ],
        'file',
        'maxSize'        => 3000000 /* 3000 кб */,
        'skipOnEmpty'    => true,
        'tooBig'         => 'Файл слишком большой. Максимальный размер - 3 Mb.',
        'extensions'     => [ 'jpg', 'png', 'gif', 'jpeg' ],
        'wrongExtension' => 'The file format is not correct. Available formats: jpg, jpeg, png, gif.',
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
      'email' => 'Email',
      'phone' => 'Phone',
      'auth_key' => 'Auth Key',
      'password_hash' => 'Password Hash',
      'password_reset_token' => 'Password Reset Token',
      'status' => 'Status',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
      'newPassword' => 'Пароль',
      'passwordRepeat' => 'Повторите пароль',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getMod()
  {
    return $this->hasOne(Mod::class, ['mod_user_id' => 'id']);
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
   * Finds user by phone
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

  /**
   * @param bool $runValidation
   * @param null $attributeNames
   *
   * @return bool
   * @throws \yii\base\Exception
   */
  public function save($runValidation = true, $attributeNames = null)
  {
    if ($this->newPassword) {
      $this->password_hash = Yii::$app->security->generatePasswordHash($this->newPassword);
    }
    return parent::save($runValidation, $attributeNames);
  }
}

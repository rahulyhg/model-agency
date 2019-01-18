<?php

namespace modules\user\common\models;

use common\behaviors\UploadFileBehavior;
use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $photo_id
 *
 * @property string $photoFile
 * @property string $photoUrl
 * @property string $photoSize
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const PHOTOS_DIR = 'user\photos';

    public $newPassword;
    public $deletePhotoFile = 0;
    public $photoFile;

    private $photoUrl;
    private $photoSize;

    public function behaviors() {
        return [
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'photo_id', 'deletePhotoFile'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [ [ 'deletePhotoFile' ], 'boolean' ],
            [
                [ 'photoFile' ],
                'file',
                'maxSize'        => 300000 /* 300 кб */,
                'skipOnEmpty'    => true,
                'tooBig'         => 'The file is too large. The maximum size is 300kb.',
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
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'photo_id' => 'Photo File ID',
        ];
    }

    /**
     * @return null|string
     */
    public function getPhotoUrl() {
        if ( ! $this->photoUrl ) {
            $this->photoUrl = Yii::$app->filestorage->getFileUrl( $this->photo_id );
            if ( ! $this->photoUrl ) {
                $this->photoUrl = Yii::$app->setting->get( 'user', 'default_photo' ) ?: null;
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
}

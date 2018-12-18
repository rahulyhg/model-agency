<?php

namespace modules\page\common\models;

use common\behaviors\UploadFileBehavior;
use modules\page\Module;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%page_page}}".
 *
 * @property integer $id
 * @property integer $thumb_id
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property PageLang[] $pagePageLangs
 */
class Page extends \modules\lang\lib\TranslatableActiveRecord
{
    const THUMB_DIR = 'page\thumbnails';

    public $newPassword;
    public $deleteThumbFile = 0;
    public $thumbFile;

    private $thumbUrl;
    private $thumbSize;

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class'     => UploadFileBehavior::class,
                'files'     => [
                    [
                        'fileAttribute'   => 'thumbFile',
                        'idAttribute'     => 'thumb_id',
                        'deleteAttribute' => 'deleteThumbFile',
                    ],
                ],
                'directory' => self::THUMB_DIR,
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['thumb_id', 'slug'], 'required'],
            [['created_at', 'updated_at', 'deleteThumbFile'], 'integer'],
            [['slug'], 'string', 'max' => 255],
            [ [ 'deleteThumbFile' ], 'boolean' ],
            [
                [ 'thumbFile' ],
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
     * @return null|string
     */
    public function getThumbUrl() {
        if ( ! $this->thumbUrl ) {
            $this->thumbUrl = Yii::$app->filestorage->getFileUrl( $this->thumb_id );
            if ( ! $this->thumbUrl ) {
                $this->thumbUrl = Yii::$app->setting->get( 'page', 'default_thumb' ) ?: null;
            }
        }

        return $this->thumbUrl;
    }

    /**
     * @return int|string
     */
    public function getThumbSize() {
        if ( ! $this->thumbSize ) {
            $path = Yii::$app->filestorage->getFilePath( $this->thumb_id );

            return $this->thumbSize = $path ? filesize( $path ) : 0;
        }

        return $this->thumbSize;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('attributeLabels', 'ID'),
            'thumb_id' => Module::t('attributeLabels', 'Thumbnail'),
            'slug' => Module::t('attributeLabels', 'URL'),
            'created_at' => Module::t('attributeLabels', 'Created at'),
            'updated_at' => Module::t('attributeLabels', 'Updated at'),
            'thumbFile' => Module::t('attributeLabels', 'Thumbnail'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagePageLangs()
    {
        return $this->hasMany(PageLang::class, ['entity_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTranslations()
    {
        return $this->hasMany(PageLang::class, ['entity_id' => 'id']);
    }
}

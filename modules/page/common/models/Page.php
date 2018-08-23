<?php

namespace modules\page\common\models;

use common\behaviors\UploadFileBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%page_page}}".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property int $thumbnail_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property string $thumbnailUrl
 * @property string $thumbnailSize
 */
class Page extends \yii\db\ActiveRecord {
	const THUMBNAILS_DIR = 'page\thumbnails';
	public $deleteThumbnailFile = 0;
	public $thumbnailFile;

	private $thumbnailUrl;

	/**
	 * {@inheritdoc}
	 */
	public static function tableName() {
		return '{{%page_page}}';
	}


	public function behaviors() {
		return ArrayHelper::merge( parent::behaviors(), [
			[
				'class'         => SluggableBehavior::class,
				'attribute'     => 'title',
				'slugAttribute' => 'slug',
				'ensureUnique'  => true,
				'immutable'     => true
			],
			[
				'class'              => TimestampBehavior::class,
				'createdAtAttribute' => 'created_at',
				'updatedAtAttribute' => 'updated_at'
			],
			[
				'class' => UploadFileBehavior::class,
				'files' => [
					[
						'fileAttribute' => 'thumbnailFile',
						'idAttribute' => 'thumbnail_id',
						'deleteAttribute' => 'deleteThumbnailFile',
					],
				],
				'directory' => self::THUMBNAILS_DIR,
			]
		] );
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			[ [ 'title' ], 'required' ],
			[ [ 'content' ], 'string' ],
			[ [ 'thumbnail_id', 'created_at', 'updated_at' ], 'integer' ],
			[ [ 'title', 'slug' ], 'string', 'max' => 255 ],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'id'           => 'ID',
			'title'        => 'Title',
			'slug'         => 'Slug',
			'content'      => 'Content',
			'thumbnail_id' => 'Thumbnail',
			'thumbnailFile' => 'Thumbnail',
			'created_at'   => 'Created At',
			'updated_at'   => 'Updated At',
		];
	}

	/**
 * @return mixed
 */
	public function getThumbnailUrl() {
		if( !$this->thumbnailUrl ) {
			$this->thumbnailUrl = Yii::$app->filestorage->getFileUrl($this->thumbnail_id);
			if( ! $this->thumbnailUrl ) {
				$this->thumbnailUrl = Yii::$app->setting->get('page', 'default_thumbnail') ?: null;
			}
		}
		return $this->thumbnailUrl;
	}

	public function getPermalink()
	{
		if($this->isNewRecord)
			return null;
		return Url::to(['/page/default/view', 'slug' => $this->slug]);
	}
}

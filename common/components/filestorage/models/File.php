<?php

namespace common\components\filestorage\models;

use common\lib\SmActiveRecord;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "filestorage".
 *
 * @property integer $id
 * @property string $path
 * @property string $original_name
 * @property string $date_create
 * @property string $date_update
 */
class File extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%filestorage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'original_name'], 'required'],
            [['date_create', 'date_update'], 'safe'],
            [['path', 'original_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Путь',
            'original_name' => 'Оригинальное имя',
            'date_create' => 'Дата создания',
            'date_update' => 'Дата обновления',
        ];
    }
}

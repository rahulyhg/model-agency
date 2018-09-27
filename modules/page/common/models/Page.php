<?php

namespace modules\page\common\models;

use Yii;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['thumb_id', 'slug'], 'required'],
            [['thumb_id', 'created_at', 'updated_at'], 'integer'],
            [['slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thumb_id' => 'Миниатюра',
            'slug' => 'URL',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего обновления',
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

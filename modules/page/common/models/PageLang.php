<?php

namespace modules\page\common\models;

use Yii;
use \modules\lang\common\models\Lang;

/**
 * This is the model class for table "{{%page_page_lang}}".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property integer $entity_id
 * @property string $title
 * @property string $content
 * @property string $seo_title
 * @property string $seo_description
 *
 * @property Page $entity
 */
class PageLang extends \modules\lang\lib\LangActiveRecord
{
    public function init()
    {
        parent::init();
        $this->notEmptyAttributes[] = 'entity_id';
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_page_lang}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang_id', 'title', 'content'], 'required'],
            [['lang_id', 'entity_id'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['seo_title'], 'string', 'max' => 70],
            [['seo_description'], 'string', 'max' => 400],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['entity_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lang_id' => 'Lang ID',
            'entity_id' => 'Entity ID',
            'title' => 'Заголовок',
            'content' => 'Контент',
            'seo_title' => 'SEO заголовок',
            'seo_description' => 'SEO описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Page::className(), ['id' => 'entity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(Lang::className(), ['id' => 'lang_id']);
    }
}

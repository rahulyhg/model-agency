<?php

use yii\db\Migration;

/**
 * Class m180925_073337_create_module_tables
 */
class m180925_073337_create_module_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page_page}}', [
            'id' => $this->primaryKey(11)->notNull(),
            'thumb_id' => $this->integer(11)->notNull(),
            'slug' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);
        $this->createTable('{{%page_page_lang}}', [
            'id' => $this->primaryKey(),
            'lang_id' => $this->integer(11)->notNull(),
            'entity_id' => $this->integer(11)->notNull(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'seo_title' => $this->string(70),
            'seo_description' => $this->string(400),
        ]);
        $this->createIndex(
            'idx-page_lang__entity_id',
            '{{%page_page_lang}}',
            'entity_id'
        );
        $this->addForeignKey(
            'fk-page_lang__page',
            '{{%page_page_lang}}',
            'entity_id',
            '{{%page_page}}',
            'id',
            'CASCADE',
            null
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-page_lang__page', '{{%page_page_lang}}');
        $this->dropIndex('idx-page_lang__entity_id', '{{%page_page_lang}}');
        $this->dropTable('{{%page_page_lang}}');
        $this->dropTable('{{%page_page}}');
    }
}

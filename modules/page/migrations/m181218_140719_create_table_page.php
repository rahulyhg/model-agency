<?php

use yii\db\Migration;

/**
 * Class m181218_140719_create_table_page
 */
class m181218_140719_create_table_page extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%page}}', [
      'id' => $this->primaryKey(11)->notNull(),
      'thumb_id' => $this->integer(11)->notNull(),
      'slug' => $this->string(255)->notNull(),
      'created_at' => $this->integer(11)->notNull(),
      'updated_at' => $this->integer(11)->notNull(),
    ]);
    $this->createTable('{{%page_lang}}', [
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
      '{{%page_lang}}',
      'entity_id'
    );
    $this->addForeignKey(
      'fk-page_lang__page',
      '{{%page_lang}}',
      'entity_id',
      '{{%page}}',
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
    $this->dropForeignKey('fk-page_lang__page', '{{%page_lang}}');
    $this->dropIndex('idx-page_lang__entity_id', '{{%page_lang}}');
    $this->dropTable('{{%page_lang}}');
    $this->dropTable('{{%page}}');
  }
}

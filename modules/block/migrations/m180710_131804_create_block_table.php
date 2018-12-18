<?php

use yii\db\Migration;

/**
 * Handles the creation of table `block`.
 * yii migrate --migrationPath=modules/block/migrations
 */
class m180710_131804_create_block_table extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%block}}', [
      'id' => $this->primaryKey(),
      'key' => $this->string(255)->notNull(),
      'content' => $this->text(),
      'description' => $this->text(),
      'css' => $this->text(),
      'js' => $this->text(),
      'created_at' => $this->integer(11)->notNull(),
      'updated_at' => $this->integer(11)->notNull(),
    ]);
    $this->createIndex('ind-block-key', '{{%block}}', 'key', true);
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('{{%block}}');
  }
}

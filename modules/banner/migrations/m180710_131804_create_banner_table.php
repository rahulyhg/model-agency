<?php

use yii\db\Migration;

/**
 * Handles the creation of table `banner`.
 * yii migrate --migrationPath=modules/banner/migrations
 */
class m180710_131804_create_banner_table extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%banner}}', [
      'id' => $this->primaryKey(),
      'name' => $this->string(255)->notNull(),
      'text' => $this->text(),
      'position' => $this->string(255)->notNull(),
      'created_at' => $this->integer(11)->notNull(),
      'updated_at' => $this->integer(11)->notNull(),
    ]);

    $this->createIndex('position_index', '{{%banner}}', 'position', $unique = true);
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropIndex('position_index', '{{%banner}}');

    $this->dropTable('{{%banner}}');
  }
}

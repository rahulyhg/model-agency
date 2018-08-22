<?php

use yii\db\Migration;

/**
 * Class m180607_123328_init_document
 * yii migrate --migrationPath=backend/modules/document/migrations
 */
class m180607_123328_init_document extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $tableOptions = null;

    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%document_entity}}', [
      'id' => $this->primaryKey(),
      'entity' => $this->char(10)->notNull(),
      'entity_id' => $this->integer()->notNull(),
    ], $tableOptions);

    $this->createTable('{{%document_data}}', [
      'id' => $this->primaryKey(),
      'document_entity_id' => $this->integer()->notNull(),
      'file_id' => $this->integer()->notNull(),
      'description' => $this->text(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
    ], $tableOptions);

    $this->createIndex('ind-document_data-document_entity_id', '{{%document_data}}', 'document_entity_id');
    $this->addForeignKey('fk-document_data-document_entity_id', '{{%document_data}}', 'document_entity_id', '{{%document_entity}}', 'id');

  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('{{%document_data}}');
    $this->dropTable('{{%document_entity}}');
  }
}

<?php

use yii\db\Migration;

/**
 * Class m181224_144832_create_table_mod_image
 */
class m181224_144832_create_table_mod_image extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%mod_image}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer(11),
      'image_id' => $this->integer(11),
      'created_at' => $this->integer(11),
      'updated_at' => $this->integer(11),
    ]);

    $this->addForeignKey('fk-mod_image-mod', '{{%mod_image}}', 'entity_id', '{{%mod}}', 'id', 'CASCADE');
    $this->addForeignKey('fk-mod_filestorage', '{{%mod_image}}', 'image_id', '{{%filestorage}}', 'id', 'CASCADE');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropForeignKey('fk-mod_filestorage', '{{%mod_image}}');
    $this->dropForeignKey('fk-mod_image-mod', '{{%mod_image}}');

    $this->dropTable('{{%mod_image}}');
  }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `spoken_lang`.
 */
class m190215_183942_create_spoken_lang_table extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%spoken_lang}}', [
      'id' => $this->primaryKey()
    ]);
    $this->createTable('{{%spoken_lang_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer(11)->notNull(),
      'lang_id' => $this->integer(11)->notNull(),
      'name' => $this->string(255)->notNull()
    ]);
    $this->addForeignKey('fk--spoken_lang_lang--spoken_lang', '{{%spoken_lang_lang}}', 'entity_id', '{{%spoken_lang}}', 'id');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropForeignKey('fk--spoken_lang_lang--spoken_lang', '{{%spoken_lang_lang}}');
    $this->dropTable('{{%spoken_lang_lang}}');
    $this->dropTable('{{%spoken_lang}}');
  }
}

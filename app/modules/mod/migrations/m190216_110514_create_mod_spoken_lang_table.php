<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mod_spoken_lang`.
 */
class m190216_110514_create_mod_spoken_lang_table extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%mod_spoken_lang}}', [
      'id' => $this->primaryKey(),
      'mod_id' => $this->integer(11)->notNull(),
      'spoken_lang_id' => $this->integer(11)->notNull()
    ]);
    $this->addForeignKey('fk--mod_spoken_lang--mod', '{{%mod_spoken_lang}}', 'mod_id', '{{%mod}}', 'id', 'CASCADE');
    $this->addForeignKey('fk--mod_spoken_lang--spoken_lang', '{{%mod_spoken_lang}}', 'spoken_lang_id', '{{%spoken_lang}}', 'id', 'CASCADE');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropForeignKey('fk--mod_spoken_lang--spoken_lang', '{{%mod_spoken_lang}}');
    $this->dropForeignKey('fk--mod_spoken_lang--mod', '{{%mod_spoken_lang}}');
    $this->dropTable('{{%mod_spoken_lang}}');
  }
}

<?php

use yii\db\Migration;

/**
 * Class m190118_143951_create_table_mod
 */
class m190118_143951_create_table_mod extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%mod}}', [
      'id' => $this->primaryKey(),
      'bust' => $this->integer(11),
      'waist' => $this->integer(11),
      'hips' => $this->integer(11),
      'eyes_color_id' => $this->integer(11),
      'hair_color_id' => $this->integer(11),
      'shoes' => $this->integer(11),
      'created_at' => $this->integer(11),
      'updated_at' => $this->integer(11),
    ]);
    $this->createTable('{{%mod_lang}}', [
      'id' => $this->primaryKey(),
      'lang_id' => $this->integer(11)->notNull(),
      'entity_id' => $this->integer(11)->notNull(),
      'first_name' => $this->string(255),
      'middle_name' => $this->string(255),
      'last_name' => $this->string(255),
    ]);

    $this->addForeignKey('fk-mod_lang-mod', '{{%mod_lang}}', 'entity_id', '{{%mod}}', 'id', 'CASCADE');
    $this->addForeignKey('fk-mod-eyes_color', '{{%mod}}', 'eyes_color_id', '{{%eyes_color}}', 'id', 'CASCADE');
    $this->addForeignKey('fk-mod-hair_color', '{{%mod}}', 'hair_color_id', '{{%hair_color}}', 'id', 'CASCADE');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropForeignKey('fk-mod-hair_color', '{{%mod}}');
    $this->dropForeignKey('fk-mod-eyes_color', '{{%mod}}');
    $this->dropForeignKey('fk-mod_lang-lang', '{{%mod_lang}}');
    $this->dropForeignKey('fk-mod_lang-mod', '{{%mod_lang}}');

    $this->dropTable('{{%mod_lang}}');
    $this->dropTable('{{%mod}}');
  }
}

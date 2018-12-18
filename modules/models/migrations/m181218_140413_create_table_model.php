<?php

use yii\db\Migration;

/**
 * Class m181218_140413_create_table_model
 */
class m181218_140413_create_table_model extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%model}}', [
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
    $this->createTable('{{%model_lang}}', [
      'id' => $this->primaryKey(),
      'lang_id' => $this->integer(11)->notNull(),
      'entity_id' => $this->integer(11)->notNull(),
      'first_name' => $this->string(255),
      'middle_name' => $this->string(255),
      'last_name' => $this->string(255),
    ]);

    $this->addForeignKey('fk-model_lang-model', '{{%model_lang}}', 'entity_id', '{{%model}}', 'id', 'CASCADE');
    $this->addForeignKey('fk-model_lang-lang', '{{%model_lang}}', 'lang_id', '{{%lang}}', 'id', 'CASCADE');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {

  }
}

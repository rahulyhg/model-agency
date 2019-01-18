<?php

use yii\db\Migration;

/**
 * Class m190118_143917_create_table_eyes_color
 */
class m190118_143917_create_table_eyes_color extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%eyes_color}}', [
      'id' => $this->primaryKey(),
      'created_at' => $this->integer(11),
      'updated_at' => $this->integer(11),
    ]);
    $this->createTable('{{%eyes_color_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer(11),
      'lang_id' => $this->integer(11),
      'color' => $this->string(15),
    ]);

    $this->addForeignKey('fk-eyes_color_lang-eyes_color', '{{%eyes_color_lang}}', 'entity_id', '{{%eyes_color}}', 'id', 'CASCADE');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropForeignKey('fk-eyes_color_lang-eyes_color', '{{%eyes_color_lang}}');

    $this->dropTable('{{%eyes_color_lang}}');
    $this->dropTable('{{%eyes_color}}');
  }
}

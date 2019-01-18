<?php

use yii\db\Migration;

/**
 * Class m190118_143938_create_table_hair_color
 */
class m190118_143938_create_table_hair_color extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%hair_color}}', [
      'id' => $this->primaryKey(),
      'created_at' => $this->integer(11),
      'updated_at' => $this->integer(11),
    ]);
    $this->createTable('{{%hair_color_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer(11),
      'lang_id' => $this->integer(11),
      'color' => $this->string(15),
    ]);

    $this->addForeignKey('fk-hair_color_lang-hair_color', '{{%hair_color_lang}}', 'entity_id', '{{%hair_color}}', 'id', 'CASCADE');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropForeignKey('fk-hair_color_lang-hair_color', '{{%hair_color_lang}}');

    $this->dropTable('{{%hair_color_lang}}');
    $this->dropTable('{{%hair_color}}');
  }
}

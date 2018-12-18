<?php

use yii\db\Migration;

/**
 * Class m181218_140334_create_table_eyes_color
 */
class m181218_140334_create_table_eyes_color extends Migration
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropTable('{{%eyes_color}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m190118_144320_create_table_country
 */
class m190118_144320_create_table_country extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%country}}', [
      'id' => $this->primaryKey(),
      'tel_code' => $this->string(5)->unique(),
    ]);
    $this->createTable('{{%country_lang}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer(11)->notNull(),
      'lang_id' => $this->integer(11)->notNull(),
      'name' => $this->string(255)->notNull()->unique(),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('{{%country}}');
    $this->dropTable('{{%country_lang}}');
  }
}

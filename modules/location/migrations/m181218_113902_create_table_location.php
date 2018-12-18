<?php

use yii\db\Migration;

/**
 * Class m181218_113902_create_table_location
 */
class m181218_113902_create_table_location extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('{{%location}}', [
        'id' => $this->primaryKey(),
      ]);
      $this->createTable('{{%location_lang}}', [
        'id' => $this->primaryKey(),
        'entity_id' => $this->integer()->notNull(),
        'lang_id' => $this->integer()->notNull(),
        'name' => $this->string(255)->notNull(),
      ]);
      $this->addForeignKey('fk-location_lang-entity_id', '{{%location_lang}}', 'entity_id', '{{%location}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('fk-location_lang-entity_id', '{{%location_lang}}');
      $this->dropTable('{{%location_lang}}');
      $this->dropTable('{{%location}}');
    }
}

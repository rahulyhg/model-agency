<?php

use yii\db\Migration;

/**
 * Class m190119_114140_create_table_manager
 */
class m190119_114140_create_table_manager extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('{{%manager}}', [
        'id' => $this->primaryKey(),
        'first_name' => $this->string(255)->notNull(),
        'last_name' => $this->string(255),
        'middle_name' => $this->string(255),
        'company_name' => $this->string(255),
        'country_id' => $this->integer(11)->notNull(),
        'created_at' => $this->integer(11)->notNull(),
        'updated_at' => $this->integer(11)->notNull()
      ]);
      $this->addForeignKey('fk--manager--country', '{{%manager}}', 'country_id', '{{%country}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('fk--manager--country', '{{%manager}}');
      $this->dropTable('{{%manager}}');
    }
}

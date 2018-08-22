<?php

use yii\db\Migration;

class m161018_130543_create_setting_module_tables extends Migration
{
  public function safeUp()
  {
    $this->createTable('{{%setting_setting}}', [
      'id' => $this->primaryKey(),
      'key' => $this->string(255)->notNull(),
      'value' => $this->text()->notNull(),
      'section' => $this->text()->notNull(),
      'description' => $this->text(),
      'created_at' => $this->integer(11)->notNull(),
      'updated_at' => $this->integer(11)->notNull(),
    ]);
  }

  public function safeDown()
  {
    $this->dropTable('{{%setting_setting}}');
  }
}

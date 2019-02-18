<?php

use yii\db\Migration;

/**
 * Class m190217_151946_likes_table_init
 */
class m190217_151946_likes_table_init extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('{{%like}}', [
      'id' => $this->primaryKey(),
      'entity_id' => $this->integer(11)->notNull(),
      'ip' => $this->string(20)->defaultValue(null),
      'user_id' => $this->integer(11),
      'created_at' => $this->integer(11)->notNull()
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('{{%like}}');
  }
}
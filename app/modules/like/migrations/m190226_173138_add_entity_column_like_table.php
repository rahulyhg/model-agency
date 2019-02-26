<?php

use yii\db\Migration;

/**
 * Class m190226_173138_add_entity_column_like_table
 */
class m190226_173138_add_entity_column_like_table extends Migration
{
    public function safeUp()
    {
      $this->addColumn('{{%like}}', 'entity', $this->char(10)->notNull());
    }

    public function safeDown()
    {
      $this->dropColumn('{{%like}}', 'entity');
    }
}

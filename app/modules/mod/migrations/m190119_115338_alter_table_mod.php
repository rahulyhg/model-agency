<?php

use yii\db\Migration;

/**
 * Class m190119_115338_alter_table_mod
 */
class m190119_115338_alter_table_mod extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->alterColumn('{{%mod}}', 'created_at', $this->integer(11)->notNull());
      $this->alterColumn('{{%mod}}', 'updated_at', $this->integer(11)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->alterColumn('{{%mod}}', 'updated_at', $this->integer(11));
      $this->alterColumn('{{%mod}}', 'created_at', $this->integer(11));
    }
}

<?php

use yii\db\Migration;

/**
 * Class m190119_115016_add_column_age_to_mod_table
 */
class m190119_115016_add_column_age_to_mod_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('{{%mod}}', 'age', $this->integer(11)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('{{%mod}}', 'age');
    }
}

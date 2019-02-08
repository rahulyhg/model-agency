<?php

use yii\db\Migration;

/**
 * Class m190206_132904_add_columns_to_mod_table
 */
class m190206_132904_add_columns_to_mod_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('{{%mod}}', 'height', $this->integer(11)->notNull());
      $this->addColumn('{{%mod}}', 'weight', $this->integer(11)->notNull());

      $this->dropColumn('{{%mod_lang}}', 'first_name');
      $this->dropColumn('{{%mod_lang}}', 'last_name');
      $this->dropColumn('{{%mod_lang}}', 'middle_name');

      $this->addColumn('{{%mod_lang}}', 'full_name', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('{{%mod_lang}}', 'full_name');

      $this->addColumn('{{%mod_lang}}', 'first_name', $this->string(255)->notNull());
      $this->addColumn('{{%mod_lang}}', 'last_name', $this->string(255)->notNull());
      $this->addColumn('{{%mod_lang}}', 'middle_name', $this->string(255)->notNull());

      $this->dropColumn('{{%mod}}', 'height');
      $this->dropColumn('{{%mod}}', 'weight');
    }
}

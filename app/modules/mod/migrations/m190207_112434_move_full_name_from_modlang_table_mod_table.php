<?php

use yii\db\Migration;

/**
 * Class m190207_112434_move_full_name_from_modlang_table_mod_table
 */
class m190207_112434_move_full_name_from_modlang_table_mod_table extends Migration
{
    public function safeUp()
    {
      $this->dropColumn('{{%mod_lang}}', 'full_name');
      $this->addColumn('{{%mod}}', 'full_name', $this->string(255)->notNull());
    }

    public function safeDown()
    {
      $this->dropColumn('{{%mod}}', 'full_name');
      $this->addColumn('{{%mod_lang}}', 'full_name', $this->string(255)->notNull());
    }
}

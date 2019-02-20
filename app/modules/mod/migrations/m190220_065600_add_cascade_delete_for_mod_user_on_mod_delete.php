<?php

use yii\db\Migration;

/**
 * Class m190220_065600_add_cascade_delete_for_mod_user_on_mod_delete
 */
class m190220_065600_add_cascade_delete_for_mod_user_on_mod_delete extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->dropForeignKey('fk--mod--mod_user', '{{%mod}}');
      $this->addForeignKey('fk--mod--mod_user', '{{%mod}}', 'mod_user_id', '{{%mod_user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('fk--mod--mod_user', '{{%mod}}');
      $this->addForeignKey('fk--mod--mod_user', '{{%mod}}', 'mod_user_id', '{{%mod_user}}', 'id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190220_065600_add_cascade_delete_for_mod_user_on_mod_delete cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m190119_113548_create_table_mod_user
 */
class m190119_113548_create_table_mod_user_add_mod_user_id_column_to_mod_table_add_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('{{%mod_user}}', [
        'id' => $this->primaryKey(),
        'email' => $this->string()->notNull()->unique(),
        'phone' => $this->string()->notNull()->unique(),
        'auth_key' => $this->string(32)->notNull(),
        'password_hash' => $this->string()->notNull(),
        'password_reset_token' => $this->string()->unique(),
        'status' => $this->smallInteger()->notNull()->defaultValue(10),
        'created_at' => $this->integer(11)->notNull(),
        'updated_at' => $this->integer(11)->notNull(),
      ]);

      $this->addColumn('{{%mod}}', 'mod_user_id', $this->integer(11)->notNull()->unique());

      $this->addForeignKey('fk--mod--mod_user', '{{%mod}}', 'mod_user_id', '{{%mod_user}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('fk--mod--mod_user', '{{%mod}}');
      $this->dropColumn('{{%mod}}', 'mod_user_id');
      $this->dropTable('{{%mod_user}}');
    }
}

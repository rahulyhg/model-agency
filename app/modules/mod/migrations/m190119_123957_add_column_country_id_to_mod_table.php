<?php

use yii\db\Migration;

/**
 * Class m190119_123957_add_column_country_id_to_mod_table
 */
class m190119_123957_add_column_country_id_to_mod_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('{{%mod}}', 'country_id', $this->integer(11));
      $this->addForeignKey('fk--mod--country', '{{%mod}}', 'country_id', '{{%country}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey('fk--mod--country', '{{%mod}}');
      $this->dropColumn('{{%mod}}', 'country_id');
    }
}

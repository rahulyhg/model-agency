<?php

use yii\db\Migration;

/**
 * Class m190115_110233_add_mod_column_images_order_json
 */
class m190115_110233_add_mod_column_images_order_json extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('{{%mod}}', 'images_order_json', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('{{%mod}}', 'images_order_json');
    }
}

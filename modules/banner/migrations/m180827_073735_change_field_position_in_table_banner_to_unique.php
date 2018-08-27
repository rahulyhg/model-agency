<?php

use yii\db\Migration;

/**
 * Class m180827_073735_change_field_position_in_table_banner_to_unique
 */
class m180827_073735_change_field_position_in_table_banner_to_unique extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createIndex('position_index', '{{%banner}}', 'position', $unique = true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropIndex('position_index', '{{%banner}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m181004_093620_alter_group_id_column_in_category_attribute_table
 */
class m181004_093620_alter_group_id_column_in_category_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-category_attribute-group_id', '{{%category_attribute}}');
        $this->alterColumn('{{%category_attribute}}', 'group_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%category_attribute}}', 'group_id', $this->integer()->notNull());
        $this->addForeignKey('fk-category_attribute-group_id', '{{%category_attribute}}', 'group_id', '{{%category_attribute_group}}', 'id', 'CASCADE');
    }
}

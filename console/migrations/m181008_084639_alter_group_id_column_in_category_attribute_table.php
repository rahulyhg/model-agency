<?php

use yii\db\Migration;

/**
 * Class m181008_084639_alter_group_id_column_in_category_attribute_table
 */
class m181008_084639_alter_group_id_column_in_category_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category_attribute_group}}', 'uid', $this->integer()->unique());

        $this->alterColumn('{{%category_attribute}}', 'group_id', $this->integer()->notNull());
        $this->addForeignKey('fk-category_attribute-group_id', '{{%category_attribute}}', 'group_id', '{{%category_attribute_group}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-category_attribute-group_id', '{{%category_attribute}}');
        $this->alterColumn('{{%category_attribute}}', 'group_id', $this->integer());

        $this->dropColumn('{{%category_attribute_group}}', 'uid');
    }
}

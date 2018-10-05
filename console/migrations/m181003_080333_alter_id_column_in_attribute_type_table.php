<?php

use yii\db\Migration;

/**
 * Class m181003_080333_alter_id_column_in_attribute_type_table
 */
class m181003_080333_alter_id_column_in_attribute_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-attribute-type_id', '{{%attribute}}');
        $this->alterColumn('{{%attribute_type}}', 'id', $this->integer()->notNull()->unique());
        $this->addForeignKey('fk-attribute-type_id', '{{%attribute}}', 'type_id', '{{%attribute_type}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-attribute-type_id', '{{%attribute}}');
        $this->dropColumn('{{%attribute_type}}', 'id');
        $this->addColumn('{{%attribute_type}}', 'id', $this->primaryKey());
        $this->addForeignKey('fk-attribute-type_id', '{{%attribute}}', 'type_id', '{{%attribute_type}}', 'id');
    }
}

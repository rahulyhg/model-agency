<?php

use yii\db\Migration;

/**
 * Class m181012_095806_alter_status_id_column_in_bulletin_table
 */
class m181012_095806_alter_status_id_column_in_bulletin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%bulletin}}', 'status_id', $this->integer()->notNull()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%bulletin}}', 'status_id', $this->integer()->notNull());
    }
}

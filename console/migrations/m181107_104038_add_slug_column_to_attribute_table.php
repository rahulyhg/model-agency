<?php

use yii\db\Migration;

/**
 * Handles adding slug to table `attribute`.
 */
class m181107_104038_add_slug_column_to_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%attribute}}', 'slug', $this->string(255));
        $this->createIndex('ind-attribute-slug', '{{%attribute}}', 'slug', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%attribute}}', 'slug');
    }
}

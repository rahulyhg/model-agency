<?php

use yii\db\Migration;

/**
 * Class m181107_121645_add_column_to_client__name
 */
class m181107_121645_add_column_to_client__name extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('{{%client}}', 'name', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('{{%client}}', 'name');
    }
}

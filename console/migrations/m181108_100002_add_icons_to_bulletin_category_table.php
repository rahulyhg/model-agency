<?php

use yii\db\Migration;

/**
 * Class m181108_100002_add_icons_to_bulletin_category_table
 */
class m181108_100002_add_icons_to_bulletin_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('{{%category}}', 'icon_file_id', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('{{%category}}', 'icon_file_id');
    }
}

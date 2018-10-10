<?php

use yii\db\Migration;

/**
 * Handles adding tr_type_setting to table `attribute_lang`.
 */
class m181005_192657_add_tr_type_setting_column_to_attribute_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%attribute_lang}}', 'tr_type_settings', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%attribute_lang}}', 'tr_type_settings');
    }
}

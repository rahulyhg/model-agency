<?php

use yii\db\Migration;

/**
 * Class m161018_090501_filestorage_component_tables_create
 * yii migrate --migrationPath=common/components/filestorage/migrations
 */
class m161018_090501_filestorage_component_tables_create extends Migration
{
    public function up()
    {
        $this->createTable('{{%filestorage}}', [
            'id' => $this->primaryKey(),
            'path' => $this->text()->notNull(),
            'original_name' => $this->text()->notNull(),
            'date_create' => $this->integer(11)->notNull(),
            'date_update' => $this->integer(11)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%filestorage}}');
    }
}

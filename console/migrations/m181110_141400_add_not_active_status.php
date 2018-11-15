<?php

use yii\db\Migration;

/**
 * Class m181110_141400_add_active_and_not_active_statuses
 */
class m181110_141400_add_not_active_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->insert('{{%bulletin_status}}', ['id' => 3, 'created_at' => time(), 'updated_at' => time()]);
      $this->batchInsert('{{%bulletin_status_lang}}', ['entity_id', 'lang_id', 'name'], [
        [3, 1, 'Неактивно'],
        [3, 2, 'Неактивно'],
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->delete('{{%bulletin_status}}', ['id' => 3]);
    }
}

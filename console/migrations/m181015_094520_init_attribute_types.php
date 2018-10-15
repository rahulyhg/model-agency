<?php

use yii\db\Migration;

/**
 * Class m181015_094520_init_attribute_types
 */
class m181015_094520_init_attribute_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
            $this->insert('{{%attribute_type}}', ['id' => 1, 'name' => 'Денежные суммы']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Денежные суммы'], ['id' => 1]);
        }
        try {
            $this->insert('{{%attribute_type}}', ['id' => 2, 'name' => 'Целое число']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Целое число'], ['id' => 2]);
        }
        try {
            $this->insert('{{%attribute_type}}', ['id' => 3, 'name' => 'Флажок']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Флажок'], ['id' => 3]);
        }
        try {
            $this->insert('{{%attribute_type}}', ['id' => 4, 'name' => 'Множественный выбор вариантов']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Множественный выбор вариантов'], ['id' => 4]);
        }
        try {
            $this->insert('{{%attribute_type}}', ['id' => 5, 'name' => 'Выбор варианта']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Выбор варианта'], ['id' => 5]);
        }
//        $this->batchInsert('{{%attribute_type}}', ['id', 'name'], [
//          [1, 'Денежные суммы'],
//          [2, 'Целое число'],
//          [3, 'Флажок'],
//          [4, 'Множественный выбор вариантов'],
//          [5, 'Выбор варианта'],
//        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181015_094520_init_attribute_types cannot be reverted.\n";

        return false;
    }
}

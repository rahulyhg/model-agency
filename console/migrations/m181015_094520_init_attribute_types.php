<?php

use modules\bulletin\common\models\AttributeType;
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
            $this->insert('{{%attribute_type}}', ['id' => AttributeType::MONEY, 'name' => 'Денежные суммы']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Денежные суммы'], ['id' => AttributeType::MONEY]);
        }
        try {
            $this->insert('{{%attribute_type}}', ['id' => AttributeType::INTEGER, 'name' => 'Целое число']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Целое число'], ['id' => AttributeType::INTEGER]);
        }
        try {
            $this->insert('{{%attribute_type}}', ['id' => AttributeType::CHECKBOX, 'name' => 'Флажок']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Флажок'], ['id' => AttributeType::CHECKBOX]);
        }
        try {
            $this->insert('{{%attribute_type}}', ['id' => AttributeType::CHECKBOX_LIST, 'name' => 'Множественный выбор вариантов']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Множественный выбор вариантов'], ['id' => AttributeType::CHECKBOX_LIST]);
        }
        try {
            $this->insert('{{%attribute_type}}', ['id' => AttributeType::SELECT, 'name' => 'Выбор варианта']);
        } catch(Exception $e) {
            $this->update('{{%attribute_type}}', ['name' => 'Выбор варианта'], ['id' => AttributeType::SELECT]);
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

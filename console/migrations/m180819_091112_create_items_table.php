<?php

use yii\db\Migration;

/**
 * Handles the creation of table `items`.
 */
class m180819_091112_create_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('items',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'amount' => $this->smallInteger()->notNull(),
            'mrp' => $this->smallInteger()->notNull(),
            'in_stock' => $this->smallInteger()->notNull()->defaultValue(10),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->smallInteger()->notNull()->defaultValue(10),
            'updated_by' => $this->smallInteger()->notNull()->defaultValue(10)
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('items');
    }
}

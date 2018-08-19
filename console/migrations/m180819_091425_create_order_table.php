<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m180819_091425_create_order_table extends Migration
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

        $this->createTable('order',[
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'amount' => $this->smallInteger()->notNull(),
            'mrp' => $this->smallInteger()->notNull(),
            'tax_rate' => $this->smallInteger()->notNull()->defaultValue(10),

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
        $this->dropTable('order');
    }
}

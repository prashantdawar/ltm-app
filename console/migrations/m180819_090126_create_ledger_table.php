<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ledger`.
 */
class m180819_090126_create_ledger_table extends Migration
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

        $this->createTable('ledger',[
            'id' => $this->primaryKey(),
            'party_id' => $this->integer()->notNull(),
            'order_id' => $this->integer()->notNull(),
            'amount' => $this->smallInteger()->notNull(),
            'mode_of_payment' => $this->string()->notNull(),

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
        $this->dropTable('ledger');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `party`.
 */
class m180819_082927_create_party_table extends Migration
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

        $this->createTable('party',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'contact_name' => $this->string()->notNull(),
            'phone' => $this->integer()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'street_address' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'location' => $this->string()->notNull(),
            'state' => $this->string()->notNull(),
            'pincode' => $this->integer()->notNull(),
            'last_order_id' => $this->integer()->notNull(),
            'gst' => $this->string()->notNull(),
            'pan' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('party');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bid}}`.
 */
class m230214_142146_create_bid_table extends Migration
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

        $this->createTable('{{%bid}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null(),
            'product_id' => $this->integer(),
            'title' => $this->string(),
            'client_name' => $this->string(),
            'phone' => $this->string(),
            'comment' => $this->text()->null(),
            'status' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);

        $this->addForeignKey('fk_bid_user_id', 'bid', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_bid_product_id', 'bid', 'product_id', 'product', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bid}}');
    }
}

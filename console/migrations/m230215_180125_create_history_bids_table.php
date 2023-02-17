<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history_bids}}`.
 */
class m230215_180125_create_history_bids_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history_bids}}', [
            'id' => $this->primaryKey(),
            'bid_id' => $this->integer(),
            'user_id' => $this->integer(),
            'field' => $this->string(),
            'old_value' => $this->text(),
            'new_value' => $this->text(),
            'created_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk_history_bids_bid_id', 'history_bids', 'bid_id', 'bid', 'id', 'CASCADE');
        $this->addForeignKey('fk_history_bids_user_id', 'history_bids', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%history_bids}}');
    }
}

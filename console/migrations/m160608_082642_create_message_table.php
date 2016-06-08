<?php

use yii\db\Migration;

/**
 * Handles the creation for table `message_table`.
 */
class m160608_082642_create_message_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        /**
         * This table contains the messages user are sending to each other
         * chat_id is foreign key of chat table
         * sender_id & receiver_id are mapped with user table
         */
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->integer()->notNull(),
            'sender_id' => $this->integer()->notNull(),
            'receiver_id' => $this->integer()->notNull(),
            'message' => $this->string()->notNull()
        ]);

        $this->createIndex('idx_message_chat_fk_1','{{%message}}','chat_id',0);
        $this->createIndex('idx_sender_fk_2','{{%message}}','sender_id',0);
        $this->createIndex('idx_receiver_fk_3','{{%message}}','receiver_id',0);

        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('message_chat_fk_1','{{%message}}', 'chat_id', '{{%chat}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->addForeignKey('message_sender_fk_2','{{%message}}', 'sender_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->addForeignKey('message_receiver_fk_3','{{%message}}', 'receiver_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->execute('SET foreign_key_checks = 1;');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%message}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

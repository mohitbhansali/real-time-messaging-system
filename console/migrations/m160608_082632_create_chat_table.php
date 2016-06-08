<?php

use yii\db\Migration;

/**
 * Handles the creation for table `chat_table`.
 */
class m160608_082632_create_chat_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        /**
         * Creating a channel to begin chat between two users
         * Channel has to be unique between two users
         * User1 & User2 can be any user
         */
        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'channel' => $this->string()->notNull()->unique(),
            'user_1' => $this->integer()->notNull(),
            'user_2' => $this->integer()->notNull(),

            'created_date' => $this->dateTime()->notNull(),
            'modified_date' => $this->dateTime(),
        ]);

        $this->createIndex('idx_user_fk_1','{{%chat}}','user_1',0);
        $this->createIndex('idx_user_fk_2','{{%chat}}','user_2',0);

        /**
         * Added user_1 & user_2 foreign key with user table
         */
        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('chat_user_fk_1','{{%chat}}', 'user_1', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->addForeignKey('chat_user_fk_2','{{%chat}}', 'user_2', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->execute('SET foreign_key_checks = 1;');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%chat}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

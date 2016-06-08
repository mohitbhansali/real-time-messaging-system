<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'user_type' => $this->smallInteger()->notNull()->defaultValue(0),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'is_deleted' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_by' => $this->integer()->notNull(),
            'created_date' => $this->dateTime()->notNull(),
            'modified_by' => $this->integer(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

        /**
         * Adding Default Data
         * For Admin User
         */
        $this->insert('{{%user}}', [
            'name' => 'Admin',
            'auth_key' => 'OO3x7-miqdPlcr2PXDSm8I6fVfM3AImT',
            'password_hash' => '$2y$13$EMbP2Nt2O3wiC34kblyLoONzuFTSEiu4af7dZL1XHFnZX34FlxEH.',
            'password_reset_token' => '',
            'email' => 'admin@bananabandy.com',
            'user_type' => '1',
            'status' => '1',
            'is_deleted' => '0',
            'created_by' => '0',
            'created_date' => '2016-06-07 00:18:40',
            'modified_by' => '',
            'modified_date' => '',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation for table `bad_words_table`.
 */
class m160608_082057_create_bad_words_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%bad_words}}', [
            'id' => $this->primaryKey(),
            'word' => $this->string()->notNull(),
            'replacement' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%bad_words}}');
    }
}

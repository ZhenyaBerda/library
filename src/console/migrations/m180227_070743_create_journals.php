<?php

use yii\db\Migration;

/**
 * Class m180227_070743_create_journals
 */
class m180227_070743_create_journals extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('journal', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ]);
        return $this->addForeignKey('journals_user_id', 'journal', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable('journal');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180227_070743_create_journals cannot be reverted.\n";

        return false;
    }
    */
}

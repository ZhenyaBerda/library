<?php

use console\migrations\Migration;

/**
 * Class m180220_052012_create_author
 */
class m180220_052012_create_author extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'firstName' => $this->string()->notNull(),
            'lastName' => $this->string()->notNull(),
            'middleName' => $this->string()->null(),
            'user_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ]);
        return $this->addForeignKey('author_user_id', 'author', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable('author');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180220_052012_create_author cannot be reverted.\n";

        return false;
    }
    */
}

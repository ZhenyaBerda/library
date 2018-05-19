<?php

use yii\db\Migration;

/**
 * Class m180428_075345_CreateAuthorAlias
 */
class m180428_071755_CreateAuthorAlias extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('author_alias', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'firstName' => $this->string()->notNull(),
            'lastName' => $this->string()->notNull(),
            'middleName' => $this->string()->null(),
            'language_id' => $this->integer()->notNull()->defaultValue(2),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ]);
        $this->addForeignKey('author_alias_author_id', 'author_alias', 'author_id', 'author', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('author_alias');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180428_075345_CreateAuthorAlias cannot be reverted.\n";

        return false;
    }
    */
}

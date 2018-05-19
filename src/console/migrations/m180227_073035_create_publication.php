<?php

use console\migrations\Migration;

/**
 * Class m180227_073035_create_publication
 */
class m180227_073035_create_publication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('publication', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'language_id' => $this->integer()->notNull(),
            'year_from' => $this->integer(4)->notNull()->defaultValue(2008),
            'year_to' => $this->integer(4)->notNull()->defaultValue(2008),
            'journal_id' => $this->integer()->notNull(),
            'scopus_id' => $this->integer()->defaultValue(0),
            'scopus_number' => $this->string()->null(),
            'doi_number' => $this->string()->null(),
            'wos_id' => $this->integer()->defaultValue(0),
            'rinch_id' => $this->integer()->defaultValue(0),
            'peer_reviewed_id' => $this->integer()->defaultValue(0),
            'conference_id' => $this->integer()->defaultValue(0),
            'isbn' => $this->string()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('publication_author_id', 'publication', 'author_id', 'author', 'id');
        $this->addForeignKey('publication_journal_id', 'publication', 'journal_id', 'journal', 'id');
        return $this->addForeignKey('publication_user_id', 'publication', 'user_id', 'user', 'id');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable('publication');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180227_073035_create_publication cannot be reverted.\n";

        return false;
    }
    */
}

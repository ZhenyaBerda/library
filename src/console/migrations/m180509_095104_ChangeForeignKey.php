<?php

use console\migrations\Migration;

/**
 * Class m180509_095104_ChangeForeignKey
 */
class m180509_095104_ChangeForeignKey extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('publication_journal_id', 'publication');
        $this->addForeignKey('publication_journal_id', 'publication', 'journal_id',
            'journal', 'id', 'CASCADE', 'CASCADE');

        $this->dropForeignKey('publication_author_author', 'publication_author');
        $this->addForeignKey('publication_author_author', 'publication_author', 'author_id',
            'author', 'id', 'CASCADE', 'CASCADE');

        $this->dropForeignKey('publication_author_publication', 'publication_author');
        $this->addForeignKey('publication_author_publication', 'publication_author', 'publication_id',
            'publication', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('publication_journal_id', 'publication');
        $this->addForeignKey('publication_journal_id', 'publication', 'journal_id',
            'journal', 'id');

        $this->dropForeignKey('publication_author_author', 'publication_author');
        $this->addForeignKey('publication_author_author', 'publication_author', 'author_id',
            'author', 'id');

        $this->dropForeignKey('publication_author_publication', 'publication_author');
        $this->addForeignKey('publication_author_publication', 'publication_author', 'publication_id',
            'publication', 'id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180509_095104_ChangeForeignKey cannot be reverted.\n";

        return false;
    }
    */
}

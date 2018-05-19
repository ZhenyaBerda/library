<?php

use console\migrations\Migration;

/**
 * Class m180427_225759_create_publication_author
 */
class m180427_225759_create_publication_author extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('publication_author', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'publication_id' => $this->integer()->notNull()
        ]);
        $this->createIndex('publication_author_unique', 'publication_author',
            ['author_id', 'publication_id'], true);

        $this->addForeignKey('publication_author_author', 'publication_author', 'author_id',
            'author', 'id');

        $this->addForeignKey('publication_author_publication', 'publication_author', 'publication_id',
            'publication', 'id');

        $this->dropForeignKey('publication_author_id', 'publication');
        $this->dropColumn('publication', 'author_id');
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('publication_author');
        $this->addColumn('publication', 'author_id', $this->integer()->defaultValue(0));
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180427_225759_create_publication_author cannot be reverted.\n";

        return false;
    }
    */
}

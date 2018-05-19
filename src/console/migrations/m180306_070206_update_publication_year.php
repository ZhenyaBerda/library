<?php

use console\migrations\Migration;

/**
 * Class m180306_070206_update_publication_year
 */
class m180306_070206_update_publication_year extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('publication', 'year_from');
        $this->dropColumn('publication', 'year_to');
        return $this->addColumn('publication', 'year', $this->integer(4)->notNull()->defaultValue(2008));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('publication', 'year');
        $this->addColumn('publication', 'year_from', $this->integer(4)->notNull()->defaultValue(2008));
        return $this->addColumn('publication', 'year_to', $this->integer(4)->notNull()->defaultValue(2008));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180306_070206_update_publication_year cannot be reverted.\n";

        return false;
    }
    */
}

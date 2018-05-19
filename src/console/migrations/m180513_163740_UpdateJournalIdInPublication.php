<?php

use console\migrations\Migration;

/**
 * Class m180513_163740_UpdateJournalIdInPublication
 */
class m180513_163740_UpdateJournalIdInPublication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('publication', 'journal_id', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('publication', 'journal_id', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180513_163740_UpdateJournalIdInPublication cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use console\migrations\Migration;

/**
 * Class m180523_181017_AddColumnPublication
 */
class m180523_181017_AddColumnPublication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('publication', 'conference_date', $this->string()->null());
        $this->addColumn('publication', 'conference_city', $this->string()->null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('publication', 'conference_date');
        $this->dropColumn('publication', 'conference_city');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180523_181017_AddColumnPublication cannot be reverted.\n";

        return false;
    }
    */
}

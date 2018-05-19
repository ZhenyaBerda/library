<?php

use console\migrations\Migration;

/**
 * Class m180513_164258_AddOutDataPublication
 */
class m180513_164258_AddOutDataPublication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('publication', 'publisher', $this->string()->null());
        $this->addColumn('publication', 'publisher_name', $this->string()->null());
        $this->addColumn('publication', 'publisher_number', $this->string()->null());
        $this->addColumn('publication', 'publisher_pages', $this->string()->null());
        $this->addColumn('publication', 'publisher_city', $this->string()->null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('publication', 'publisher');
        $this->dropColumn('publication', 'publisher_name');
        $this->dropColumn('publication', 'publisher_number');
        $this->dropColumn('publication', 'publisher_pages');
        $this->dropColumn('publication', 'publisher_city');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180513_164258_AddOutDataPublication cannot be reverted.\n";

        return false;
    }
    */
}

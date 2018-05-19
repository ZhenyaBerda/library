<?php

use console\migrations\Migration;

/**
 * Class m180508_054209_AddFileExistPublication
 */
class m180508_054209_AddFileExistPublication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('publication', 'file_exist', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('publication', 'file_exist');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180508_054209_AddFileExistPublication cannot be reverted.\n";

        return false;
    }
    */
}

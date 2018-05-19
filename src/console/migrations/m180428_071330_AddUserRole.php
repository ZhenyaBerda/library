<?php

use console\migrations\Migration;

/**
 * Class m180428_071330_AddUserRole
 */
class m180428_071330_AddUserRole extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role_id', $this->integer()->defaultValue(0)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180428_071330_AddUserRole cannot be reverted.\n";

        return false;
    }
    */
}

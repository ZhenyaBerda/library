<?php

use yii\db\Migration;

/**
 * Class m180523_183836_AddColumnTypePublication
 */
class m180523_183836_AddColumnTypePublication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('publication', 'type_id', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('publication', 'type_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180523_183836_AddColumnTypePublication cannot be reverted.\n";

        return false;
    }
    */
}

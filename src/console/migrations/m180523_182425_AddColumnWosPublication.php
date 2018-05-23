<?php

use yii\db\Migration;

/**
 * Class m180523_182425_AddColumnWosPublication
 */
class m180523_182425_AddColumnWosPublication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('publication', 'wos_id');
        $this->addColumn('publication', 'wos', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('publication', 'wos');
        $this->addColumn('publication', 'wos_id', $this->integer()->defaultValue(0));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180523_182425_AddColumnWosPublication cannot be reverted.\n";

        return false;
    }
    */
}

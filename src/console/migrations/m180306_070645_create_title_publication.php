<?php

use console\migrations\Migration;

/**
 * Class m180306_070645_create_title_publication
 */
class m180306_070645_create_title_publication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        return $this->addColumn('publication', 'title', $this->string()->notNull()->defaultValue('Нет названия'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropColumn('publication', 'title');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180306_070645_create_title_publication cannot be reverted.\n";

        return false;
    }
    */
}

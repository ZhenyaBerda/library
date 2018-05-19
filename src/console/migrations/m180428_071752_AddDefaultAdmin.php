<?php

use console\migrations\Migration;

/**
 * Class m180428_071752_AddDefaultAdmin
 */
class m180428_071752_AddDefaultAdmin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        return $this->insert('user', [
            'username' => 'Admin',
            'email' => 'admin@eltech-library.sadykh.ru',
            'password_hash' => '$2y$13$36WBpqoLZWadYndqdicKjueqNvUDH0nf2.k/n1dtWZ7YToOeAMiCS',
            'auth_key' => 'nIwgts_zg3BJ-Bu2RMmIQ2qgHLzSEv9T',
            'role_id' => 1,
            'status' => 10,
            'created_at' => '1524899833',
            'updated_at' => '1524899833',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->delete('user', ['username' => 'Admin']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180428_071752_AddDefaultAdmin cannot be reverted.\n";

        return false;
    }
    */
}

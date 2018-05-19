<?php

namespace console\migrations;

class Migration extends \yii\db\Migration
{
    public $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';

    public function createTable($table, $columns, $options = null)
    {
        if ($options == null) {
            $options = $this->tableOptions;
        }
        parent::createTable($table, $columns, $options);
    }

    public function string($length = null)
    {
        if ($length == null) {
            $length = 191;
        }
        return parent::string($length);
    }
}
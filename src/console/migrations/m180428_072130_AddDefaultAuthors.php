<?php

use yii\db\Migration;
use common\models\User;
use common\models\Author;
use common\models\AuthorAlias;

/**
 * Class m180428_072130_AddDefaultAuthors
 */
class m180428_072130_AddDefaultAuthors extends Migration
{
    public $authorList = [
        'Бутусов Денис Николаевич' => 'Butusov Denis Nikolaevich',
        'Андреев Валерий Сергеевич' => 'Andreev Valery Sergeevich',
        'Каримов Артур Искандарович' => 'Karimov Artur Iskandarovich',
        'Каримов Тимур Искандарович' => 'Karimov Timur Iskandarovich',
        'Красильников Александр Витальевич' => 'Krasilnikov Alexander Vitalievich',
        'Островский Валерий Юрьевич' => 'Ostrovskii Valery Yurievich',
        'Тутуева Александра Вадимовна' => 'Tutueva Alexandra Vadimovna',
        'Горяинов Сергей Вадимович' => 'Goryainov Sergey Vadimovich',
        'Рыбин Вячеслав Геннадьевич' => 'Rybin Vyacheslav Gennadievich',
        'Копец Екатерина Евгеньевна​' => 'Kopets Ekaterina Evgenievna',
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = User::findOne(['username' => 'Admin']);

        foreach ($this->authorList as $ruFullName => $enFullName) {
            $author = explode(' ', $ruFullName);
            $this->insert('author', [
                'lastName' => $author[0],
                'firstName' => $author[1],
                'middleName' => $author[2],
                'user_id' => $user->id,
                'created_at' => '1524899833',
                'updated_at' => '1524899833',
            ]);
            $author = Author::find()->byFullName($author[1], $author[0], $author[2])->one();
            $authorAlias = explode(' ', $enFullName);
            $this->insert('author_alias', [
                'lastName' => $authorAlias[0],
                'firstName' => $authorAlias[1],
                'middleName' => $authorAlias[2],
                'author_id' => $author->id,
                'language_id' => AuthorAlias::LANG_EN,
                'created_at' => '1524899833',
                'updated_at' => '1524899833',
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->authorList as $ruFullName => $item) {
            $author = explode(' ', $ruFullName);
            $this->delete('author', [
                'lastName' => $author[0],
                'firstName' => $author[1],
                'middleName' => $author[2],
                'created_at' => '1524899833',
                'updated_at' => '1524899833',
            ]);
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180428_072130_AddDefaultAuthors cannot be reverted.\n";

        return false;
    }
    */
}

<?php

namespace common\helpers;

use common\models\Author;

class AuthorHelper
{

    /**
     * Статусы авторов
     * @return array
     */
    public static function getStatusList()
    {
        return [
            Author::STATUS_NO_ACTIVE => 'Не опубликован',
            Author::STATUS_ACTIVE => 'Опубликован',
        ];
    }
}
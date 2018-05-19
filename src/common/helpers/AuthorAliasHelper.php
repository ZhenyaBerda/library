<?php

namespace common\helpers;

use common\models\Author;
use common\models\Journal;
use common\models\Publication;
use yii\helpers\ArrayHelper;

class AuthorAliasHelper
{


    public static function getAuthorsList()
    {
        $result = [];
        $model = Author::find()->all();
        foreach ($model as $item) {
            $result[$item->id] = $item->lastName . ' ' . $item->firstName . ' ' . $item->middleName;
        }
        return $result;
    }

    public static function getLanguageList()
    {
        return [
            1 => 'Русский',
            2 => 'Английский'
        ];
    }


}
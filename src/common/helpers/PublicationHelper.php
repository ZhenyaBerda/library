<?php

namespace common\helpers;

use common\models\Author;
use common\models\Journal;
use common\models\Publication;
use yii\helpers\ArrayHelper;

class PublicationHelper
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

    /**
     * Получить список годов
     * @return array
     */
    public static function getAgeList()
    {
        $result = [];
        for ($i = 2018; $i > 2010; $i--) {
            $result[$i] = $i;
        }
        return $result;
    }

    public static function getAuthorsList()
    {
        $result = [];
        $model = Author::find()->all();
        foreach ($model as $item) {
            $result[$item->id] = $item->lastName . ' ' . $item->firstName . ' ' . $item->middleName;
        }
        return $result;
    }

    public static function getPublisherNames()
    {
        $model = Publication::find()->all();
        return ArrayHelper::map($model, 'publisher_name', 'publisher_name');
    }

    public static function getJournalList()
    {
        $model = Journal::find()->all();
        return ArrayHelper::map($model, 'id', 'title');
    }

    public static function getLanguageList()
    {
        return [
            1 => 'Русский',
            2 => 'Английский'
        ];
    }


}
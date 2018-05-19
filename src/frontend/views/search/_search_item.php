<?php

use yii\helpers\Html;
use dastanaron\translit\Translit;

/**
 * @var $model \common\models\Publication
 * @var $searchModel \common\search\PublicationSearch
 */

?>
<li>
    <?php
    $extraData = [];
    $publisherData = [];
    $publisherFields = ['getPublisher_name', 'getPublisher', 'getPublisher_number', 'getPublisher_city', 'getYear', 'getPublisher_pages'];
    $textLink = '';
    $authorsList = [];
    foreach ($model->authors as $author) {
        $authorsList[$author->id] = $author->lastName . ' ' . mb_substr($author->firstName, 0, 1) . '.';
        if ($author->middleName) {
            $authorsList[$author->id] .= mb_substr($author->middleName, 0, 1) . '.';
        }
    }
    $authorText = implode(', ', $authorsList);
    if ($model->language_id == \common\models\Publication::LANG_EN) {
        $translit = new Translit();
        $authorText = $translit->translit($authorText, false, 'ru-en');
    }
    $textLink = $authorText;
    $textLink .= ' ' . $model->title . ' // ';

    foreach ($publisherFields as $publisherField) {
        if ($model->{$publisherField}()) {
            $publisherData[] = $model->{$publisherField}();
        }
    }
    if (count($publisherData)) {
        $textLink .= implode($publisherData, ', ');
    }
    if ($model->doi_number && $searchModel->displayDoi) {
        $extraData[] = 'DOI: ' . $model->doi_number;
    }
    if ($model->scopus_number && $searchModel->displayScopus) {
        $extraData[] = 'Scopus ID: ' . $model->scopus_number;
    }
    if ($model->isbn && $searchModel->displayIsbn) {
        $extraData[] = 'ISBN: ' . $model->isbn;
    }

    if (count($extraData)) {
        $textLink .= '(' . implode($extraData, ', ') . ')';
    }

    if ($model->file_exist) {
        echo Html::a($textLink, $model->getFileOnWeb(), ['_target' => 'blank']);
    } else {
        echo $textLink;
    }
    ?>

</li>
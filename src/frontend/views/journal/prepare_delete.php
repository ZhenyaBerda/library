<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/** @var $data \common\models\Journal */
/* @var $searchModel common\search\PublicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Удаление журнала: ' . $data->title;
$this->params['breadcrumbs'][] = ['label' => 'Журналы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        При удалении журнала будут удалены следующие публикации:
    </p>
    <ul>
        <li>
            <?php
            foreach ($data->publications as $model) {
                $textLink = '';
                $authorsList = [];
                foreach ($model->authors as $author) {
                    $authorsList[$author->id] = $author->lastName . ' ' . mb_substr($author->firstName, 0, 1) . '.';
                    if ($author->middleName) {
                        $authorsList[$author->id] .= mb_substr($author->middleName, 0, 1) . '.';
                    }
                }
                $textLink = implode(', ', $authorsList);
                $textLink .= ' ' . $model->title . ' ';
                $textLink .= '// ' . $model->journal->title . ' ';
                $textLink .= $model->year . '. ';
                if ($model->doi_number) {
                    $textLink .= '(DOI ' . $model->doi_number . ')';
                }

                if ($model->file_exist) {
                    echo Html::a($textLink, $model->getFileOnWeb());
                } else {
                    echo $textLink;
                }
            }
            ?>

        </li>
        <a class="btn btn-danger" href="/journal/delete-post?id=<?=$data->id?>" title="Удалить" aria-label="Удалить" data-pjax="0" data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="post">Удалить</a>
    </ul>
</div>

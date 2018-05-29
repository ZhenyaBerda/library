<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\PublicationHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\search\PublicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';

?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>
<br>
    <p>
        <?= Html::a('Добавить публикацию', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'title',
                'content' => function ($model) {
                    $dots = strlen($model->title) > 30 ? '...' : '';
                    return mb_substr($model->title, 0, 30) . $dots;
                }
            ],
            'year',
            [
                'attribute' => 'language_id',
                'content' => function ($model) {
                    $statusList = PublicationHelper::getLanguageList();
                    return $statusList[$model->language_id];
                }
            ],
            [
                'attribute' => 'authorListId',
                'content' => function ($model) {
                    $result = [];

                    /**
                     * @var $author \common\models\Author
                     */
                    foreach ($model->authors as $author) {
                        $result[] = $author->getShortFullName();
                    }
                    return implode(', ', $result);
                }
            ],
            [
                'attribute' => 'publisher_name',
                'content' => function ($model) {
                    $dots = strlen($model->publisher_name) > 30 ? '...' : '';
                    return mb_substr($model->publisher_name, 0, 30) . $dots;
                }
            ],

            [

                'class' => ActionColumn::className(),
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('Редактировать', $url);
                    }
                ]
            ],
            [
                'class' => ActionColumn::className(),
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Удалить', $url, ['data-method'=>'post']);
                    }
                ]
            ],
//            [
//                    'atribute'=>'isbn',
//                'content' => function ($model) {
//                    $statusList = PublicationHelper::search();
//                    return $statusList[$model->isbn];
//                }
//            ],
        ],
    ]); ?>
</div>

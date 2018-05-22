<?php

use common\helpers\AuthorHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\search\AuthorSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторы';

?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить автора', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => ['width' => '10'],
            ],
            'firstName',
            'lastName',
            'middleName',
//            [
//                'attribute' => 'publication',
//                'label' => 'Публикаций',
//                'headerOptions' => ['width' => '10'],
//                'content' => function ($model) {
//                    return count($model->publications);
//                }
//            ],
            [
                'label' => 'Псевдонимы',
                'headerOptions' => ['width' => '10'],
                'content' => function ($model) {
                    return Html::a('Управление псевдонимами', ['/author-alias/index', 'author_id' => $model->id]);
                }
            ],
            [

//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{delete}',
//                'headerOptions' => ['width' => '20'],
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
        ],
    ]); ?>
</div>

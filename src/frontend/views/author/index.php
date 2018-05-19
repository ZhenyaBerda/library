<?php

use common\helpers\AuthorHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\search\AuthorSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info" role="alert">
        На данной странице указаны только авторы, которых вы добавили. Изменять или удалять авторов других
        пользователей вы не имеете возможности.
    </div>
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
            [
                'attribute' => 'publication',
                'label' => 'Публикаций',
                'headerOptions' => ['width' => '10'],
                'content' => function ($model) {
                    return count($model->publications);
                }
            ],
            [
                'label' => 'Псевдонимов',
                'headerOptions' => ['width' => '10'],
                'content' => function ($model) {
                    return Html::a(count($model->authorAliases), ['/author-alias/index', 'author_id' => $model->id]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'headerOptions' => ['width' => '20'],

            ]
        ],
    ]); ?>
</div>

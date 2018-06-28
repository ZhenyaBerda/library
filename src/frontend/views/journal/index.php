<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use common\helpers\JournalHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\search\Journal */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Журналы';

//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="journal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => ['width' => '10'],
            ],
            [
                'attribute' => 'title',
                'content' => function ($model) {
                    $dots = strlen($model->title) > 125 ?  '...' : '';
                    return mb_substr($model->title, 0, 125) . $dots;
                }],
            [
                'attribute' => 'publication',
                'label' => 'Публикации',
                'headerOptions' => ['max-width' => '10'],
                'content' => function ($model) {
                    return count($model->publications);
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
        ],
    ]); ?>
</div>

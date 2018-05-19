<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\JournalHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\search\Journal */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Журналы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="alert alert-info" role="alert">
        На данной странице указаны только журналы, которые вы добавили. Изменять или удалять журналы других
        пользователей вы не имеете возможности.
    </div>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
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
                'label' => 'Публикаций',
                'headerOptions' => ['max-width' => '10'],
                'content' => function ($model) {
                    return count($model->publications);
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

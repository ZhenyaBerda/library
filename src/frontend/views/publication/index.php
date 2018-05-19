<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\PublicationHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\search\PublicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info" role="alert">
        На данной странице указаны только публикации, которые вы добавили. Изменять или удалять публикации других
        пользователей вы не имеете возможности.
    </div>

    <p>
        <?= Html::a('Добавить публикацию', ['create'], ['class' => 'btn btn-success']) ?>
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'headerOptions' => ['width' => '20'],
            ],
        ],
    ]); ?>
</div>

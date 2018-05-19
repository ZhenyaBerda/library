<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AuthorAlias */

$this->title = 'Обновление псевонима:';
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['/author/index', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->author->getFullName(), 'url' => ['index', 'author_id' => $model->author_id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="author-alias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

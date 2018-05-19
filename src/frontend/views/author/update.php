<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Author */

$this->title = 'Обновление автора: ' . $model->firstName . ' ' . $model->lastName;
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление: ' . $model->getFullName();
?>
<div class="author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

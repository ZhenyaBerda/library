<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Publication */

$this->title = 'Обновление публикации: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Публикации', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление публикации: ' . $model->title;
?>
<div class="publication-update">

    <h1><?= Html::encode($model->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

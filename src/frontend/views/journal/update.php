<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Journal */

$this->title = 'Обновление журнала: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Журналы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление: ' . $model->title;
?>
<div class="journal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

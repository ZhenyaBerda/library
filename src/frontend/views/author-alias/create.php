<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AuthorAlias */

$this->title = 'Добавление псевдонима автора';

?>
<div class="author-alias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\search\PublicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'author_id') ?>

    <?= $form->field($model, 'language_id') ?>

    <?= $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'year_to') ?>

    <?php // echo $form->field($model, 'journal_id') ?>

    <?php // echo $form->field($model, 'scopus_id') ?>

    <?php // echo $form->field($model, 'scopus_number') ?>

    <?php // echo $form->field($model, 'doi_number') ?>

    <?php // echo $form->field($model, 'wos_id') ?>

    <?php // echo $form->field($model, 'rinch_id') ?>

    <?php // echo $form->field($model, 'peer_reviewed_id') ?>

    <?php // echo $form->field($model, 'conference_id') ?>

    <?php // echo $form->field($model, 'isbn') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

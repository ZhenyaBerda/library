<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\PublicationHelper;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Publication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'title')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'year')->dropDownList(PublicationHelper::getAgeList()) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'journal_id')->widget(\kartik\select2\Select2::className(), [
                'initValueText' => 'Выберите журнал',
                'options' => ['placeholder' => 'Поиск журнала'],
                'data' => [$model->journal->id => $model->journal->title],
                'value' => [$model->journal->title],
                'pluginOptions' => [
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Поиск результатов...'; }"),
                    ],
                    'ajax' => [
                        'url' => \yii\helpers\Url::to(['journal']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(city) { return city.text; }'),
                    'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                ],
            ]); ?>
        </div>
        <div class="col-md-3" style="margin-top: 30px">
            <?= $form->field($model, 'rinch_id')->checkbox() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'authorListId')->widget(\kartik\select2\Select2::class, [
                'initValueText' => 'Выберите автора', // set the initial display text
                'options' => ['placeholder' => 'Поиск автора', 'multiple' => true],
                'data' => $model->getAuthorListFullname(),
                'value' => $model->getAuthorListId(),
                'maintainOrder' => true,

                'pluginOptions' => [
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Поиск результатов...'; }"),
                    ],
                    'ajax' => [
                        'url' => \yii\helpers\Url::to(['author']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'tokenSeparators' => [',', ' '],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(city) { return city.text; }'),
                    'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                ],
            ]); ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'language_id')->dropDownList(PublicationHelper::getLanguageList()) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'doi_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3" style="margin-top: 30px">
            <?= $form->field($model, 'wos_id')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'publisher_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'publisher_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'publisher_pages')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'publisher_city')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3" style="margin-top: 25px">
            <?= $form->field($model, 'scopus_id')->checkbox() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'scopus_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3" style="margin-top: 30px">
            <?= $form->field($model, 'peer_reviewed_id')->checkbox() ?>
        </div>
        <div class="col-md-3" style="margin-top: 30px">
            <?= $form->field($model, 'conference_id')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>
        <div class="col-md-3">
            <?php if ($model->file_exist) {
                echo 'Файл доступен по ' . Html::a('ссылке', $model->getFileOnWeb());
            } ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

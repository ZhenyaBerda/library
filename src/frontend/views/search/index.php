<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\helpers\PublicationHelper;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $searchModel common\search\PublicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поиск публикаций';

?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="publication-search">

        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>

        <div class="row">
            <div class="col-md-9">
                <?= $form
                    ->field($searchModel, 'authorListId')
                    ->widget(Select2::class, [
                        'initValueText' => 'Выберите автора',
                        'options' => ['placeholder' => 'Поиск автора', 'multiple' => true],
                        'maintainOrder' => true,
                        'data' => $searchModel->getAuthorListFullname(),
                        'value' => $searchModel->getAuthorListId(),
                        'pluginOptions' => [
                            'language' => [
                                'errorLoading' => new JsExpression("function () { return 'Поиск результатов...'; }"),
                            ],
                            'ajax' => [
                                'url' => Url::to(['/publication/author']),
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
                <?= $form->field($searchModel, 'title')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($searchModel, 'publisher_name')->dropDownList(ArrayHelper::merge([null => 'Все'], PublicationHelper::getPublisherNames())) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($searchModel, 'language_id')->dropDownList(ArrayHelper::merge([null => 'Все'], PublicationHelper::getLanguageList())) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($searchModel, 'year_from')->dropDownList(ArrayHelper::merge([null => 'Все'], PublicationHelper::getAgeList())) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($searchModel, 'year_to')->dropDownList(PublicationHelper::getAgeList()) ?>
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <?= $form->field($searchModel, 'isbn')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($searchModel, 'doi_number')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($searchModel, 'scopus_number')->textInput(['maxlength' => true]) ?>
            </div>

        </div>


        <div class="row">
            <div class="col-md-3" style="margin-top: 20px">
                <?= $form->field($searchModel, 'scopus_id')->checkbox() ?>
            </div>

            <div class="col-md-3" style="margin-top: 20px">
                <?= $form->field($searchModel, 'rinch_id')->checkbox() ?>
            </div>

            <div class="col-md-3" style="margin-top: 20px">
                <?= $form->field($searchModel, 'wos_id')->checkbox() ?>
            </div>
        </div>
        <div class="row">

            <div class="col-md-3">
                <?= $form->field($searchModel, 'displayDoi')->checkbox() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($searchModel, 'displayScopus')->checkbox() ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($searchModel, 'displayIsbn')->checkbox() ?>
            </div>
        </div>


        <div class="form-group">
            <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php \yii\bootstrap\ActiveForm::end(); ?>

    </div>
                <ul>
                    <?= \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_search_item',
                        'viewParams' => ['searchModel' => $searchModel],
                    ]); ?>
                </ul>
</div>

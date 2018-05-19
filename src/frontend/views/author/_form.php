<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\AuthorHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Author */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="author-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <div class="alert alert-info" role="alert">
                Данные поля обязательны для заполнения. Пожалуйста, заполняйте на русском языке.
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'middleName')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4" style="margin-top: 15px">
            <div class="alert alert-info" role="alert">
                <p>Поле <b>Отчество</b> заполняется при его наличии.</p>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

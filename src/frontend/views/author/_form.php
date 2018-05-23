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
        <div class="col-md-5">

            <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'middleName')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <br>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

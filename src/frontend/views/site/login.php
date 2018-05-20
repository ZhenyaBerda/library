<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход в систему';
?>
<div class="site-login">
    <legend class="offset-3"><?= Html::encode($this->title) ?></legend>


    <div class="row">
        <div class="col-lg-5 offset-lg-3">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <a class="offset-1" href="http://local.eltech-library.ru/site/signup">Зарегистрироваться</a>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php


/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Главная страница';
?>


<div class="site-index">

    <div class="jumbotron">

        <h1>Добро пожаловать!</h1>
        <br>
        <h3>Вы находитесь на главной странице электронной библиотеки СПбГЭТУ "ЛЭТИ"</h3>
        <br>
        <? if (Yii::$app->user->isGuest) :?>
        <p>Для работы с электронной библиотекой <a href="http://local.eltech-library.ru/site/login">войдите</a> в систему</p>
        <p>или <a href="http://local.eltech-library.ru/site/signup">зарегистрируйтесь</a></p>
        <? else:?>
           <p class="text-muted">
            <?=  Html::a("Выйти из системы", ['site/logout'], [
                                'data' => ['method' => 'post'],
                                ['class' => 'white text-center']
                            ]
                        );?>
           </p>
        <? endif;?>
    </div>
</div>

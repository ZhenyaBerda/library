<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php

if (Yii::$app->user->isGuest)
{
$menuItems = [
    ['label' => 'Главная', 'url' => "http://local.eltech-library.ru"],
    ['label' => 'Поиск', 'url' => "http://local.eltech-library.ru/search/index"],
    ['label' => 'Войти', 'url' => "http://local.eltech-library.ru/site/login"],

];
} else {
    $menuItems = [
        ['label' => 'Главная', 'url' => "http://local.eltech-library.ru"],
        ['label' => 'Поиск', 'url' => "http://local.eltech-library.ru/search/index"],
        ['label' => 'Авторы', 'url' => "http://local.eltech-library.ru/author"],
        ['label' => 'Публикации', 'url' => "http://local.eltech-library.ru/publication"],
        ];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript"> (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter47969459 = new Ya.Metrika({
                        id: 47969459,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true,
                        webvisor: true,
                        trackHash: true
                    });
                } catch (e) {
                }
            });
            var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () {
                n.parentNode.insertBefore(s, n);
            };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks"); </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/47969459" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript> <!-- /Yandex.Metrika counter -->
</head>
<body>
<?php $this->beginBody() ?>
<div class="bs-component">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="http://local.eltech-library.ru">Библиотека "ЛЭТИ"</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="nav navbar-nav ml-auto">
                 <? foreach ($menuItems as $element) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $element['url']?>"><?= $element['label']?></a>
                </li>
                 <? endforeach?>
            </ul>
        </div>
    </nav>
</div>
<div class="wrap">

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

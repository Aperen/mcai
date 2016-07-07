<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Carousel;
use yii\widgets\Breadcrumbs;

/* 引入前置资源 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->charset ?>">
<head>
    <meta charset="UTF-8">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

    <?php
    $session = Yii::$app->session;      //获取 session 对象
    $session->open();           //开启 session
    $user=$session->get("username");            // 获取 session 中的用户名
    $userName = isset($user)?
        "首页（".$user."）":"首页";
    $logout=$userName!="首页"?"注销":"登陆";
    $logoutUrl=$logout!="登陆"?"/front/logout":"/front/login";
    NavBar::begin([
        'brandLabel' => '近之言与',
        'brandUrl' => "#",
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' =>$userName, 'url' => ['/front/index']],
            ['label' => '关于', 'url' => ['/front/about']],
            ['label' => '联系', 'url' => ['/front/contact']],
            ['label' => $logout, 'url' => [$logoutUrl]],
        ],
    ]);
    NavBar::end();
    ?>
    <?php
    echo Carousel::widget([
        'items' => [
            // the item contains only the image
            '<img src="img/Logo.jpg"/>',
            // equivalent to the above
            ['content' => '<img src="img/Logo1.jpg"/>'],
            // the item contains both the image and the caption
            [
                'content' => '<img src="img/Logo3.jpg"/>',
                //'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
                //'options' => ["xiao"],
        ],
    ]
]);

    ?>
<?php $this->beginBody() ?>
<div class="container">
    <?= $content ?>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Blog <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>

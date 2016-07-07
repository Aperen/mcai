<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/7/4
 * Time: 12:36
 */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;


/* 引入前置资源 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->charset ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body  style="background:rgb(239, 238, 238);">
<header class="wrap">
    <div class="m-photos">
        <img src="img/photos.png" alt="">
    </div>
    <div>

        <ul class="nav nav-stacked menu">
            <li role="presentation" class="active"><a href="<?php echo Url::to(['front/index']);?>">返回首页</a></li>
            <li role="presentation"><a href="<?php echo Url::to(['admin/theme']);?>">主题设置</a></li>
            <li role="presentation"><a href="<?php echo Url::to(['admin/article']); ?>">文章管理</a></li>
            <li role="presentation"><a href="<?php echo Url::to(['files/index']); ?>">媒体管理</a></li>
            <li role="presentation"><a href="#">插件管理</a></li>
            <li role="presentation"><a href="<?php echo Url::to(['user/index']);?>">用户管理</a></li>
            <li role="presentation"><a href="#">数据维护</a></li>
        </ul>

    </div>
</header>
<?php $this->beginBody() ?>

<div class="container" style="float: left;">
    <?= $content ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

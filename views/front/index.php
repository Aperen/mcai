<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/6/27
 * Time: 14:01
 */
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;




AppAsset::register($this);          //注册前端资源

$session = Yii::$app->session;      //获取 session 对象
if($session->isActive){         //检查 session 是否激活
    $userName=$session->get("username");            // 获取 session 中的用户名
    $this->params['userName']=$userName;        //把用户名赋值对页面参数
}
?>

<!-- 分类目录 -->
<div class="row category">
    <div class="col-lg-2">
        <span class="m-span  f-csp f-usn">分类目录</span>
    </div>
    <div class="col-lg-9">
        <ul>
            <?php foreach ($category as $row){ ?>
                <li>
                    <span class="m-span f-csp f-usn">
                        <?php echo $row['title']; ?>
                    </span>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<!-- 文章列表 -->

<?php for($i=1;$i< sizeof($article)+1;$i++) { ?>
    <?php if($i % 2 != 0) echo "<div class='row'>";?>
        <div class="col-lg-5  f-fl m-article">
            <div style="margin-top:10px;">
                <img src="img/thumbnail.png" style="width:100%;height=100%;"/>
            </div>
            <div>
                <h3><a href="<?php echo Url::to(["/front/article"]);echo "&id=".$article[$i-1]['id']; ?>"><?php echo $article[$i-1]['title']; ?></a></h3>
            </div>
            <br>
            <div class="f-usn">
                作者：<?php echo $article[$i-1]['author']; ?></a>&nbsp;
                更新日期：<?php echo Yii::$app->formatter->asDate($article[$i-1]['update_date'],'php:Y-m-d'); ?>&nbsp;
                阅读量：<?php echo $article[$i-1]['read_num']; ?><br><br>
                <div class="article-less">
                    <!-- PHP 中一个汉字用占三个字符位，并去除HTML标签-->
                    <?php echo mb_substr(strip_tags($article[$i-1]['content']),0,100,"utf-8")."..."; ?>
                </div>
            </div>
        </div>
    <?php if($i % 2 == 0) echo "</div><br><br><br>";?>

<?php } ?>

<br><br>

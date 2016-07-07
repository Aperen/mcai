<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/7/4
 * Time: 9:31
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$session = Yii::$app->session;      //获取 session 对象
if($session->isActive){         //检查 session 是否激活
    $userName=$session->get("username");            // 获取 session 中的用户名
    $this->params['userName']=$userName;        //把用户名赋值对页面参数
}
?>
<br>
<div class="row">
    <h1><?php echo $article['title']; ?></h1>
</div>
<br>
<hr size="1">
<br>
<div class="row">
    <div class="col-lg-8">
        作者：<?php echo $article['author'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;
        更新时间：<?php echo $article['update_date'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;
        分类：未分类&nbsp;&nbsp;|&nbsp;&nbsp;
        阅读量：<?php echo $article['read_num'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;
    </div>
</div>
<br>
<div class="row" style="line-height: 30px;">
    <div class="col-lg-12">
         <?php echo $article['content'] ?>
    </div>
</div>
    <input name="is_login" type="hidden" id="is_login" value="<?php echo $is_login; ?>">
    <input name="article_id" type="hidden" id="article_id" value="<?php echo $article['id']; ?>">
<hr size="2">
<!--弹出框-->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">十分有情的且万分温暖的提示</h4>
                </div>
                <div class="modal-body">
                    你爸爸是不是在和你说，你还没有登陆？只有登陆之后才能发表评论呢！
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="goLogin">去登陆</button>
                </div>
            </div>
        </div>
    </div>

<!--评论区-->
<div class="row">
    <div class="col-lg-10">
        <textarea id="comment" class="form-control"></textarea>
    </div>
    <div class="col-lg-1">
        <button class="btn btn-primary" id="btn_comment" data-toggle="modal" data-target=".bs-example-modal-lg">提交</button>
    </div>
</div>
    <br><br>
<?php for($i = 0;$i<sizeof($comment);$i++){ ?>
    <div class="row">
        <div class="col-lg-10">
            <div class="alert-info" style="height:35px;font-size: 22px;-webkit-border-radius: ;-moz-border-radius: ;border-radius: 10px;">
                <?php echo $comment[$i]['content']."------>发表于".$comment[$i]['post_date']; ?>
            </div>
        </div>
    </div>
    <br><br>
<?php } ?>
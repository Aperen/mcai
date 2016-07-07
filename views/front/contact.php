<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/7/4
 * Time: 10:01
 */
$session = Yii::$app->session;      //获取 session 对象
if($session->isActive){         //检查 session 是否激活
    $userName=$session->get("username");            // 获取 session 中的用户名
    $this->params['userName']=$userName;        //把用户名赋值对页面参数
}
?>

<br><br><br><br>
<div class="col-lg-12">
    <span style="font-size: 25px;">不用联系我了，本人已经在你身后了！</span>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Article */

use yii\widgets\ActiveForm;

?>
<br><br>
<div class="row">
    <div class="col-lg-8 col-md-6 col-sm-3">
        <input type="text" class="form-control" id="title" placeholder="请输入文章标题"/>
    </div>
    <br><br><br>
</div>
<div class="row">
    <div class="col-lg-2">
        <select id="author" class="form-control">
            <option value='' disabled selected style='display:none;'>请选择作者</option>
            <?php foreach ($user as $row){ ?>
                <option><?php echo $row['username']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-lg-2">
        <select id="category" class="form-control">
            <option value='' disabled selected style='display:none;'>请选择分类</option>
            <?php foreach ($category as $row){ ?>
                <option><?php echo $row['title']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-lg-2">
        <input type="date" id="post_date" class="form-control" />
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
    </div>
    <div class="col-lg-2">
        <button class="btn btn-defaultt" id="post_article">发表文章</button>
    </div>
</div>
<br><br><br>
<div class="row"></div>
    <div class="col-lg-10 col-md-5 col-sm-3">
        <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain" style="height:350px">

        </script>
    </div>
<br>

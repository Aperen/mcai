<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Update Article: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<br xmlns="http://www.w3.org/1999/html"><br>
<div class="row">
    <div class="col-lg-8 col-md-6 col-sm-3">
        <input type="text" class="form-control" id="title" value="<?php echo $model['title']; ?>" />
    </div>
    <br><br><br>
</div>
<div class="row">
    <div class="col-lg-2">
        <select id="author" class="form-control">
            <option><?php echo $model['author']; ?></option>
            <?php foreach ($user as $row){ ?>
                <option><?php echo $row['username']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-lg-2">
        <select id="category" class="form-control">
            <option>未分类</option>
            <?php foreach ($category as $row){ ?>
                <option><?php echo $row['title']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-lg-2">
        <input type="date" id="post_date" class="form-control" value="<?php echo $model['post_date'];?>"/>
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <input name="id" type="hidden" id="id" value="<?php echo $id;?>">
    </div>
    <div class="col-lg-2">
        <button class="btn btn-defaultt" id="post_update">发表文章</button>
    </div>
</div>
<br><br><br>
<div class="row"></div>
<div class="col-lg-10 col-md-5 col-sm-3">
    <!-- 加载编辑器的容器 -->
    <script id="container" name="content" type="text/plain" style="height:350px">
        <?php echo $model['content'];  ?>
    </script>
</div>
<br>

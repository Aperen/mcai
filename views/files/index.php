<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filesMange */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-index">

    <br><br><br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('上传文件', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <br><br><br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'file_id',
            'file_name',
            'file_size',
            'file_url:url',
            'file_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<div class="alert-danger" style="height:42px">
    <span style = "font-size:22px">
        * 注意：目前系统只支持图片格式（.jpg/.png）的文件上传！
    </span>
</div>
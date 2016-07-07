/**
 * Created by xiaoaix on 2016/7/5.
 */


$(function () {

    UE.getEditor('container');
    $('[data-toggle="popover"]').popover();
})
//文章提交请求，向后台发送文章提交请求
$("#post_article").bind("click",function(){
    var $title=$("#title").val();       //获取文章标题
    var $author =$("#author").val();        //获取文章作者
    var $category =$("#category").val();       //获取文章分类
    var $post_date=$("#post_date").val();      //获取文章发表时间
    var $content = UE.getEditor('container').getContent();  //获取文章内容
    var $csrfToken = $('#_csrf').val();
    $.ajax({
        type:'post',
        url:"index.php?r=admin/save-article",
        data:{
            _csrf:$csrfToken,
            title:$title,
            author:$author,
            category:$category,
            post_date:$post_date,
            content:$content
        },
        success:function (date) {
            window.location.href="index.php?r=admin/article";
        }
    });

});
//文章更新按钮，向后台发起更新文章的请求
$("#post_update").bind("click",function(){
    var $title=$("#title").val();       //获取文章标题
    var $author =$("#author").val();        //获取文章作者
    var $category =$("#category").val();       //获取文章分类
    var $post_date=$("#post_date").val();      //获取文章发表时间
    var $content = UE.getEditor('container').getContent();  //获取文章内容
    var $csrfToken = $('#_csrf').val();
    var $id = $('#id').val();
    $.ajax({
        type:'post',
        url:"index.php?r=admin/post-update",
        data:{
            _csrf:$csrfToken,
            title:$title,
            author:$author,
            category:$category,
            post_date:$post_date,
            content:$content,
            id:$id,
        },
        success:function (date) {
            console.log(date);
        }
    });
});
//提示框的登陆按钮事件
$("#goLogin").bind("click",function(){
    window.location.href="index.php?r=front/login";
})
//评论提交按钮向后台发送提交请求
$("#btn_comment").bind("click",function(){

    $is_login=$("#is_login").val();
    //console.log($is_login);
    if($is_login=="false"){         //如果还没有登陆
        //弹出登陆的弹窗
        $('[role="dialog"]').modal();
    }else{          //如果已经登陆
        //向后台发送 Ajax 请求
        $content=$('#comment').val();
        $article_id = $('#article_id').val();
        $.ajax({
            type:'POST',
            url:'index.php?r=front/comment',
            data:{
                content:$content,
                article_id:$article_id,
            },
            success:function($date){
                console.log($date);
                window.location.href="index.php?r=front/article&id="+$article_id;            }
        });
    }
});

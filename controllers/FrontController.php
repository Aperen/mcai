<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/7/3
 * Time: 12:10
 */

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\User;
use app\models\Category;
use app\models\Article;
use app\models\Comment;

class FrontController extends Controller{
    //指定模板
    public $layout = "front";
    //关闭 Csrf 验证
    public $enableCsrfValidation = false;
    //首页操作
    public function actionIndex(){
        //返回首页
        return $this->render("index",[
            'category'=>$this->getCategory(),
            'article'=>$this->getArticle(),
        ]);
    }
    //登陆页操作
    public function actionLogin(){
        $user = new User();
        $v = Yii::$app->request->post();
        $error="宾客光临寒舍，在下有失迎！";
        if($v){
            if($user->validateLogin($v)){   //验证用户名和密码
                //将用户名写入 SESSION
                $session=Yii::$app->session;        //获取Session对象
                $session->open();           //开启 Session
                $session->set('username',$v['User']['username'],3600);   //将用户名写入Session
                //返回首页
                return $this->render("index",[
                    'category'=>$this->getCategory(),
                    'article'=>$this->getArticle(),
                ]);
            }else{
                $error="请填写正确的用户名和密码！";
            }
        }

        //返回视图并传值
        return $this->render("login",[
            'user' => $user,
            'error'=>$error,
        ]);
    }
    //登出操作
    public function actionLogout(){
        $sesson = Yii::$app->session;       //获取 Session
        $sesson->remove("username");        //移除用户名
        return $this->redirect(Url::to(['front/index']));
    }
    //文章页操作
    public function actionArticle(){
        $id = Yii::$app->request->get("id");        //用 URL 中 取出文章ID
        $article=Article::findOne(['id'=> $id]);    //在数据库中查询该ID所在的文章信息
        $comment = $this->getComment($id);          //传入文章 ID ，返回该文章的评论内容
        $isLogin = $this->getIsLogin()?"true":"false";             //判断用户是否已经登陆
        //返回文章详情页的视图
        return $this->render("article",[
            'article' => $article,
            'comment' => $comment,
            'is_login' => $isLogin,
        ]);
    }
    //注册页操作
    public function actionRegist(){
        $user = new User();     //实例化用户模型
        $error = "";            //消息变量
        $request=Yii::$app->request->post();    //获取 request 对象
        if(isset($request['User'])){                //视图是否请交用户请求
            $userName = $request["User"]["username"];       //获取请求中的用户名
            $passWord = $request["User"]["password"];       //获取请求中的密码
            $r=User::findOne(['username'=>$userName]);      //查询用户名是否存在
            if(isset($r)){                              //如果用户名存在
                $error = "你来晚了，用户名已经存在！";       //给出用户名存在的消息提示
            }else{                                      //如果用户名不存在
                $user->id="Null";                       // 给 User->Id 赋值
                $user->username=$userName;              //给 User->username 赋值
                $user->password=$passWord;              //给 User->password 赋值
                $user->save();                          //将新用户保存至数据库
                $error = "小确幸哦~注册成功了！";     //给出注册成功的消息提示
            }
        }
        //返回视图并传值
        return $this->render("regist",[
            'user' => $user,
            'error' => $error,
        ]);
    }
    //关于页操作
    public function actionAbout(){
        return $this->render("about");
    }
    //联系页操作
    public function actionContact(){
        return $this->render("contact");
    }
    //发表评论操作
    public function actionComment(){
        $comment = new Comment();
        $datetime = date('y-m-d h:i:s',time()+3600*6);     //获取当前时间
        $userId = $this->getUsernameBySession();      //获取当前登陆用户的 ID
        $content = Yii::$app->request->post("content"); //获取提交的评论内容
        $article_id=Yii::$app->request->post("article_id"); //获取文章 ID
        $comment->id="NULL";
        $comment->content=$content;
        $comment->article_id=$article_id;
        $comment->post_date=$datetime;
        $comment->author_id =$userId;
        if($comment->save()){
            return "评论发表成功";
        }else{
            return "评论发表失败";
        }
    }
    //获取文章分类
    public function getCategory(){
        //查询文章分类
        $category = Category::find()->all();
        return $category;                    //返回文章分类
    }
    //获取文章内容
    public function getArticle(){
        //查询文章内容并传送到首页
        //出于对性能的考虑，文章内容截取之后单独传送
        $article = Article::find()->all();
        return $article;
    }
    //获取文章评论内容
    public function getComment($id){
        //查询文章评论,按照 ID 倒序排列
        $comment = Comment::find()
            ->where(['article_id'=>$id])
            ->orderBy('id')
            ->all();
        return $comment;
    }
    //检查用户的登陆状态
    public function getIsLogin(){
        $session=Yii::$app->session;
        $session->open();
        if($session['username']){
            return true;
        }
        return false;
    }
    //获取当前登陆用户的 ID
    public function getUsernameBySession(){
        $session = Yii::$app->session;
        $session->open();
        $username =$session->get("username");
        $userId = User::findOne(['username'=>$username])->id;
        return $userId;
    }
    //控制器测试操作
    public function actionTest(){
        $datetime = date('y-m-d h:i:s',time());     //获取当前时间
        echo $datetime;
    }
}
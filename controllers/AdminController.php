<?php

namespace app\controllers;

use app\models\Category;
use app\models\User;
use Yii;
use app\models\Article;
use app\models\ArticleMange;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * AdminController implements the CRUD actions for Article model.
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout="Admin";
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    //文章管理操作
    public function actionArticle(){
        if(!$this->findUser()){         //如果用户会话信息不存在
            //跳转到登陆页面
            return $this->redirect(Url::to(["front/login"]));
        }
        $searchModel = new ArticleMange();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('article', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    //查看文章信息操作
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    //后台首页操作
    public function actionIndex(){
        if(!$this->findUser()){         //如果用户会话信息不存在
            //跳转到登陆页面
            return $this->redirect(Url::to(["front/login"]));
        }
        return  $this->render('index');
    }
    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    //文章列表操作
    public function actionCreate()
    {
        if(!$this->findUser()){         //如果用户会话信息不存在
            //跳转到登陆页面
            return $this->redirect(Url::to(["front/login"]));
        }
        $user=User::find()->all();
        $category=Category::find()->all();
        return $this->render('create',[
            'user'=>$user,
            'category'=>$category,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    //更新文章操作
    public function actionUpdate($id)
    {
        if(!$this->findUser()){         //如果用户会话信息不存在
            //跳转到登陆页面
            return $this->redirect(Url::to(["front/login"]));
        }
        $model = $this->findModel($id);
        $user=User::find()->all();
        $category=Category::find()->all();
        return $this->render('update', [
            'model' => $model,
            'user'=> $user,
            'category' =>$category,
            'id'=>$id,
        ]);
    }
    //文章更新操作
    public function actionPostUpdate(){
        $article = new Article();       // 实例化文章模型
        $id = Yii::$app->request->post("id");               // 获取ID
        $title = Yii::$app->request->post("title");     //获取文章标题
        $author = Yii:: $app->request->post("author");      //获取文章作者
        $post_date= Yii::$app -> request ->post("post_date");   //获取文章发表日期
        $content = Yii:: $app -> request->post("content");  //获取文章内容
        //将获取到的值都写入数据库
        $article=Article::findOne($id);
        $article -> title =$title;
        $article -> author = $author ;
        $article->post_date=Yii::$app->formatter->asDate($post_date,"php:Y-m-d");
        $article->update_date=Yii::$app->formatter->asDate($post_date,"php:Y-m-d");
        $article->category_id=-1;
        $article->content=$content;
        $article->update();
        echo "OK";
    }
    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    //删除文章操作
    public function actionDelete($id)
    {
        if(!$this->findUser()){         //如果用户会话信息不存在
            //跳转到登陆页面
            return $this->redirect(Url::to(["front/login"]));
        }
        $this->findModel($id)->delete();

        return $this->redirect(Url::to(["admin/article"]));
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //保存文章操作
    public function actionSaveArticle(){
        $article = new Article();       // 实例化文章模型
        $id = "NULL";               // ID为自增长
        $title = Yii::$app->request->post("title");     //获取文章标题
        $author = Yii:: $app->request->post("author");      //获取文章作者
        $post_date= Yii::$app -> request ->post("post_date");   //获取文章发表日期
        $content = Yii:: $app -> request->post("content");  //获取文章内容
        //将获取到的值都写入数据库
        $article -> id = $id;
        $article -> title =$title;
        $article -> author = $author ;
        $article->post_date=Yii::$app->formatter->asDate($post_date,"php:Y-m-d");
        $article->update_date=Yii::$app->formatter->asDate($post_date,"php:Y-m-d");
        $article->category_id=-1;
        $article->content=$content;
        $article->save();
    }
    //主题设置页操作
    public function actionTheme(){
        return $this->render("theme");
    }
    //媒体管理页操作
    public function actionMedia(){
        return $this->render("media");
    }
    //在 Session 中查找用户方法
    public function findUser(){
        $session =Yii::$app->session;       //获取 Session 对象
        $session->open();                       //开启 Sesssion
        $username=$session->get("username");        //获取用户名
        if(!isset($username)){                  //如果用户名的会话不存在
            return false;               //返回为假
        }else{                  //否则
            return true;        //返回为真
        }
    }
    //控制器的测试方法
    public function actionTest(){
        $article = new Article();
        $article -> id = "NULL";
        $article -> title ="title";
        $article -> author = "xiao" ;
        $article->post_date=Yii::$app->formatter->asDate("2015-09-08","php:Y-m-d");
        $article->update_date=Yii::$app->formatter->asDate("2015-09-08","php:Y-m-d");
        $article->category_id=-1;
        $article->content="content";
        $article->save();
    }
}

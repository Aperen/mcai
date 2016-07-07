<?php

namespace app\controllers;

use Faker\Provider\File;
use Yii;
use app\models\files;
use app\models\filesMange;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * FilesController implements the CRUD actions for files model.
 */

class FilesController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "Admin";
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

    /**
     * Lists all files models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new filesMange();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single files model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UploadForm();
        $files = new files();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {

                $fileName=$model->imageFile->baseName;      //文件名
                $fileType=$model->imageFile->extension;     //文件扩展名
                $fileSize=$model->imageFile->size;          //文件字节数
                //如果小到 1MB 则用 KB 单位计算，如是大于或等于 1MB 用 MB 为单位计算
                //注意如何区分是 1KB 还是 1MB？
                $fileSize=$fileName>=1024?$this->fileSizeParse($fileSize,"MB"):$this->fileSizeParse($fileSize,"KB");
                $fileUrl="uploads/";        //上传文件路径
                //将上传文件的数据写入数据库
                $files ->file_id="NULL";
                $files->file_name=$fileName;
                $files->file_type=$fileType;
                $files->file_size=$fileSize;
                $files->file_url=$fileUrl;
                if($files->save()){             //保存文件
                    return;         //上传文件成功
                }else{
                    var_dump($files->errors);   //输出错误
                }
            }

        }
            return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing files model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->file_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing files model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = files::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //文件大小计算
    public function fileSizeParse($fileSize,$unit){
        if($unit == "KB"){
            return round($fileSize/1024,3);
        }elseif($unit == "MB"){
            return round($fileSize/1024/1024,3);
        }elseif($unit == "GB"){
            return round($fileSize/1024/1024/1024,3);
        }elseif($unit == "PB"){
            return round($fileSize/1024/1024/1024/1024,3);
        }else{                  //超出范围，返回字节数
            return $fileSize;
        }
    }

    //控制器测试操作
    public function actionTest(){
        $files= new Files();
        $files ->file_id="NULL";
        $files->file_name="test";
        $files->file_type=".jpg";
        $files->file_size=1;
        $files->file_url="uploads/";
        $files->save();
    }
}

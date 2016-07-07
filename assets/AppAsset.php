<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/reset.css',    //Reset CSS
        'css/site.css',     // Default CSS
        'css/front.css',    //Front CSS for Blog
        'css/admin.css',    //Admin CSS for Blog
        'css/ueditor.css',
    ];
    public $img =[
        'img/Logo.jpg',
        'img/thumbnail.png',
        'img/photos.png',
        'img/login.png',
    ];
    public $js = [
        'ueditor/ueditor.config.js',
        'ueditor/ueditor.all.min.js',
        'ueditor/zh-cn.js',
        'ueditor/myueditor.js',
    ];
    public $mp3=[
        'a.mp3',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

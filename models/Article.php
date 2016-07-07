<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $author
 * @property integer $category_id
 * @property string $post_date
 * @property string $update_date
 * @property integer $read_num
 * @property string $thumbnail_url
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'author', 'post_date', 'update_date'], 'required'],
            [['category_id', 'read_num'], 'integer'],
            [['post_date', 'update_date'], 'safe'],
            [['title', 'author'], 'string', 'max' => 50],
            [['content'], 'string', 'max' => 10000],
            [['thumbnail_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'title' => '文章标题',
            'content' => '正文',
            'author' => '作者',
            'category_id' => '分类',
            'post_date' => '发表日期',
            'update_date' => '更新日期',
            'read_num' => '阅读数',
            'thumbnail_url' => '缩略图路径',
        ];
    }
}

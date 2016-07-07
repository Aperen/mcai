<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $article_id
 * @property string $post_date
 * @property integer $author_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'article_id', 'post_date', 'author_id'], 'required'],
            [['article_id', 'author_id'], 'integer'],
            [['post_date'], 'safe'],
            [['content'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'article_id' => 'Article ID',
            'post_date' => 'Post Date',
            'author_id' => 'Author ID',
        ];
    }
}

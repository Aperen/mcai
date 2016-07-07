<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $file_id
 * @property string $file_name
 * @property double $file_size
 * @property string $file_url
 * @property string $file_type
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name', 'file_url'], 'required'],
            [['file_size'], 'number'],
            [['file_name', 'file_url'], 'string', 'max' => 255],
            [['file_type'], 'string', 'max' => 10],
            [['file_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => '文件编码',
            'file_name' => '文件名称',
            'file_size' => '文件大小',
            'file_url' => '文件存放位置',
            'file_type' => '文件类型',
        ];
    }
}

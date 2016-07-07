<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $emial
 * @property string $num
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'max' => 255],
            [['emial'], 'string', 'max' => 50],
            [['num'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编码',
            'username' => '用户名',
            'password' => '密码',
            'emial' => '邮件',
            'num' => '号码',
        ];
    }

    public function validateLogin($v)
    {
        if(isset($v['User']['username'])){      //如果用户名传值不为空
            //查询该用户名所在的记录
            $r=$this->findOne(['username'=>$v['User']['username']]);
            if($r){         //如果该条纪录存在
                if($r->password==$v['User']['password']){   //验证密码是否相符
                    return $r->username;        //返回用户名
                }
            }
        }
        return false;       //返回为假
    }
}

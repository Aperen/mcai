# "近之言与"博客网站的设计与实现（一期） #

# 前言 #

还有一点点时间，还有一点点空间，为我们俩设计与实现一个有关于生活与爱情的网站。一个属于我们自己的空间，一个只有我们俩的天地，以此纪念我们美好的生活与爱情。

# 设计 #

设计思路：我不是设计出身，也没有多少设计的观念和原则。在当下开放的信息环境里，但是我有幸站在了巨人的肩膀上，去眺望更远的地方。参考了很多的信息、书籍、网站，最终设计出这套看上去还算简洁的界面。

## 功能设计 ##



## 框线图设计 ##

### 首页（Index） ###

![Index](http://i.imgur.com/dCtPZa1.jpg)

### 文章页（Article） ###

![Article](http://i.imgur.com/3YUhTMQ.jpg)

### 登陆页（Login） ###


### 注册页（Regist） ###

### 关于页（About） ###

### 联系页（Contact) ###

### 后台管理页（Admin） ###

### 文章编写页（Article-Write) ###

### 用户管理页（User-Mange） ###

## 数据库设计 ##

### 文章分类表（Table for category） ###

字段名|字段类型|字段长度|是否主键|唯一约束|允许为空|自增长
-|
ID|INT|DEFAULT|YES|YES|NO|YES|
TITLE|VARCHAR|50|NO|YES|NO|NO|

SQL语句

	CREATE TABLE `category` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `title` varchar(50) NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `category_id_uindex` (`id`),
	  UNIQUE KEY `category_title_uindex` (`title`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8


### 文章表（Table for article） ###

字段名|字段类型|字段长度|是否主键|唯一约束|允许为空|自增长|默认
-|
id|INT|DEFAULT|YES|YES|NO|YES||
title|VARCHAR|50|NO|NO|NO|NO||
content|VARCHAR|10000|NO|NO|NO|NO||
author|VARCHAR|50|NO|NO|NO|NO||
category_id|INT|DEFAULT|NO|NO|NO|NO|-1|
post_date|DATETIME|DEFAULT|NO|NO|NO|NO||
update_date|DATETIME|DEFAULT|NO|NO|NO|NO||
read_num|INT|DEFAULT|NO|NO|NO|NO|0|
thumbnail_url|VARCHAR|255|NO|NO|YES|NO||

SQL 语句

	CREATE TABLE `article` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `title` varchar(50) NOT NULL,
	  `content` varchar(10000) NOT NULL,
	  `author` varchar(50) NOT NULL,
	  `category_id` int(11) NOT NULL DEFAULT '-1',
	  `post_date` datetime NOT NULL,
	  `update_date` datetime NOT NULL,
	  `read_num` int(11) NOT NULL DEFAULT '0',
	  `thumbnail_url` varchar(255) DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `table_name_id_uindex` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8


### 文件表(Files Table) ###



	CREATE TABLE `files` (
	  `file_id` int(11) NOT NULL AUTO_INCREMENT,
	  `file_name` varchar(255) NOT NULL,
	  `file_size` float DEFAULT NULL,
	  `file_url` varchar(255) NOT NULL,
	  `file_type` varchar(10) DEFAULT NULL,
	  PRIMARY KEY (`file_id`),
	  UNIQUE KEY `files_file_id_uindex` (`file_id`),
	  UNIQUE KEY `files_file_name_uindex` (`file_name`)
	) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8

# 实现 #

## 问题与解决方法 ##

1. 使用数据模型传值，接收不到；

	    <?= $form->field($user, 'username')->textInput() ?>
	    <?= $form->field($user, 'password')->passwordInput() ?>

	原因是传送过到的值即不是一维数组，也不是对象，而是二维数组（如图）

	![Q1](http://i.imgur.com/RSMovQn.jpg)

	接收的代码如下：

		$v=Yii::$app->request->post();
		echo $v['User']['username'];

2. 使用 Ajax 发送 POST 请求，出现状态码 400 错误，GET请求可以。

	原因是 Yii 开启了 csfr 验证，如果在 POST 请求中没有 csrf 字段就会出现这种情况。

	解决方法有三（参考1），如下：

	2.1 关闭 csrf 验证，但这样不安全

		public function init(){
	    $this->enableCsrfValidation = false;
	
		}
	
	2.2 在表单中添加 csrf 的隐藏域

		<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

	2.2 在 Ajax 中添加 csrf 数据

			var csrfToken = $('meta[name="csrf-token"]').attr("content");
			$.ajax({
			  type: 'POST',
			  url: url,
			  data: {_csrf:csrfToken},
			  success: success,
			  dataType: dataType
			});

	最终我是把第二种方法和第三种方法结合了，因为页面中可能会没有 meta 相应标签。

3. php 中的 sub_str() 函数截取中文乱码。

	用 mb_substr() 函数替代。

	# 总结 #

# 参考 #

<?php
/*
*	应用整体配置文件
*/

return [
	'db' 	=> [
		'db' 	=> 'mysql', //数据库类型
		'host'  => 'localhost', //主机名称
		'port'  => '3306',	//默认端口
		'user'	=> 'root',	//用户名
		'pass'	=> 'ygdl86250977', //密码
		'charset' => 'utf8', //默认字符集
		'dbname'=> 'php_practice' //数据库名称
	],
	'app' 	=> [
		'default_platform' => 'home',
	],
	'admin' => [
		'default_controller' => 'Index',
		'default_action'	 => 'index'
	],
	'home'  => [
		'default_controller' => 'Student',
		'default_action'	 => 'list'
	]
];
<?php
/*
*	框架基础类，引导类，总控制器
*/
class Base
{
	/*run 供入口文件调用*/
	public function run()
	{
		/*获取应用配置文件*/
		$this->loadConfig();
		/*注册自动加载*/
		$this->registerAutoLoad();
		/*获取参数请求*/
		$this->getRequestParams();
		/*获取自定义控制器*/
		$this->dispatch();
	}

	public function loadConfig()
	{
		$GLOBALS['config'] = require './application/config/config.php';
	}

	/*加载用户自定义创建的类 方法*/
	public function userAutoLoad($className)
	{
		/*定义基础类库*/
		$baseClass = [
			'Model' => './framework/Model.php',
			'Db'	=> './framework/Db.php'
		];
		/*判断调用：基础类？自定义模型类？自定义控制器类？*/
		if (isset($baseClass[$className])) {
			require $baseClass[$className];
		} elseif (substr($className, -5) == 'Model') {
			require './application/home/model/' . $className . '.php';
		} elseif (substr($className, -10) == 'Controller') {
			require './application/home/controller/' . $className . '.php';;
		}
	}

	/*注册自动加载类方法*/
	public function registerAutoLoad()
	{
		spl_autoload_register([$this, 'userAutoLoad']);
	}

	/*获取应用配置参数*/
	public function getRequestParams()
	{
		/*获取默认模块*/
		$platform = $GLOBALS['config']['app']['default_platform'];
		$p = $_GET['p'] ?? $platform;
		define('PLATFORM', $p);

		/*获取默认控制器*/
		$c = $GLOBALS['config'][$p]['default_controller'];
		$c = $_GET['c'] ?? $c;
		define('CTL', $c);

		/*获取默认方法*/
		$a = $GLOBALS['config'][$p]['default_action'];
		$a = $_GET['a'] ?? $a;
		define('ACT', $a);
	}

	/*请求分发*/
	public function dispatch()
	{
		/*实例化控制器*/
		$controllerName = CTL . 'Controller';
		$controller = new $controllerName;
		/*调用控制器方法*/
		$action = ACT;
		$controller->$action();
	}
}
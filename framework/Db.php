<?php
/*
*	PDO连接 MYSQL
*	单例模式
*
* MySQLi和PDO很相似，都有两方面主要区别：
*
* 1.MySQLi只能访问MySQL，但PDO可以访问12种不同的数据库
*
* 2.PDO没有普通函数调用(mysqli_*functions)
*/
class Db
{
	private static $instance = null;

	protected $dbConfig = [
		'db' 	=> 'mysql', //数据库类型
		'host'  => 'localhost', //主机名称
		'port'  => '3306',	//默认端口
		'user'	=> 'root',	//用户名
		'pass'	=> 'ygdl86250977', //密码
		'charset' => 'utf8', //默认字符集
		'dbname'=> 'php_practice' //数据库名称
	];

	private $conn = null; //数据库连接实例
	public $num;
	public $insertid;

	private function __construct($parames)
	{
		$this->dbConfig = array_merge($this->dbConfig, $parames);
		$this->connect();
	}

	/* 防止外部克隆新对象 */
	private function __clone()
	{

	}

	public static function getinstance($parames)
	{
		if (!self::$instance instanceof self) {
			self::$instance = new self($parames);
		}
		return self::$instance;
	}

	public function connect()
	{
		$dsn = "{$this->dbConfig['db']}:host={$this->dbConfig['host']};dbname={$this->dbConfig['dbname']};";
		try{
			/*连接PDO实例*/
			$this->coon = new PDO($dsn, $this->dbConfig['user'], $this->dbConfig['pass'], array(PDO::ATTR_PERSISTENT => true));
			/*设置客户端的默认字符集*/
			$this->coon->query("SET NAMES {$this->dbConfig['charset']}");
		} catch (PDOException $e) {
			die("Errorl:" . $e->getMessage() . "<br />");
		}
	}

	/*
	*	pdo 增删改
	*/
	public function exec($sql)
	{
		$num =  $this->coon->exec($sql);
		if ($num > 0) {
			if (!empty($this->coon->lastInsertId())) {
				$this->insertid = $this->coon->lastInsertId();
			}
			$this->num = $num;
		} else {
			$error = $this->coon->errorInfo();
			var_dump($error);
		}
	}

	/*
	*	pdo 查一条数据
	*	PDO::FETCH_ASSOC 结果集返回数组形式
	*/
	public function fetch($sql)
	{
		return $this->coon->query($sql)->fetch(PDO::FETCH_ASSOC);
	}

	/*
	*	pdo 查多条数据
	*	PDO::FETCH_ASSOC 结果集返回数组形式
	*/
	public function fetchAll($sql)
	{
		$test = $this->coon->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		return $test;
	}
}

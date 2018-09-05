<?php
/*
*	公共模型
*	连接数据库
*/
class Model
{
	private $db = null;
	
	protected $data = null;

	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		$dbConfig = ['user' => 'root', 'pass' => 'ygdl86250977', 'dbname' => 'php_practice'];
		$this->db = Db::getinstance($dbConfig);
	}

	/*
		查询单数据
	*/
	public function get($sql)
	{
		return $this->db->fetch($sql);
	}

	/*
		查询多数据
	*/
	public function getAll($sql)
	{
		return $this->db->fetchAll($sql);
	}
}
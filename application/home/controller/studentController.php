<?php
/* 
*	MVC原生开发
*	控制器层
*/

/* 引入模型层 */
class studentController
{
	public function detail()
	{
		$student = new studentModel();
		$sql = 'select * from student where id = 3';
		var_dump($student->get($sql));
	}

	public function list()
	{
		$student = new studentModel();
		$sql 	 = 'select * from student';
		$list	 = $student->getAll($sql);
		require './application/home/view/student_list.php';
	}
}
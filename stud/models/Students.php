<?php


class Students
{
	public static function getStudentsItemByID($id)
	{
		$id = intval($id);

		if ($id) 
		{
			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM students WHERE student_id=' . $id);

			/*$result->setFetchMode(PDO::FETCH_NUM);*/
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$StudentsItem = $result->fetch();

			return $StudentsItem;
		}

	}

	/**
	* Returns an array of Students items
	*/
	public static function getStudentsListByGroupId($group_id)
	{
		$db = Db::getConnection();
		$res = $db->query("SELECT (student_id) FROM study_in WHERE group_id = '$group_id'");
		$i = 0;
		$studentsList = array();
		while($stud_id = $res->fetch())
		{
			$studentsList[$i] = array();
			$stud_id = $stud_id['student_id'];
			$student_res = $db->query("SELECT * FROM students WHERE student_id = '$stud_id'"); 
			$student = $student_res->fetch();
			if (!empty($student))
			{
				$studentsList[$i]['student_id'] = $student['student_id'];
				$studentsList[$i]['student_name'] = $student['student_surname'].' '.$student['student_name'] . ' ' . $student['student_patronymic'];
			}

			$i++;
		}
		if ($i == 0)
		  return false;
		return $studentsList;
	}
	public static function getStudentsList() {	
}

}
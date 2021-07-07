<?php


include_once ROOT. '/models/Subjects.php';

class Groups
{

	public static function getExamsListByGroupIdInDate($group_id, $start_date, $end_date)
	{
		$db = Db::getConnection();
		$result = $db->query("SELECT * FROM exams WHERE group_id = '$group_id' and exam_date <= '$end_date' and exam_date >= '$start_date'");

		$examsList = array();
		$i = 0;
		while ($row = $result->fetch())
		{
			$sub_id = $row['subject_id'];
			$subject = Subjects::getSubjectItemByID($row['subject_id']);
			if (!$subject)
			{
				$result2 = $db->query("SELECT * FROM subjects_archive WHERE subject_id = '$sub_id'");
				$subject = $result2->fetch();
			}
			for ($j = 0; $j < $i; $j++)
			  if ($examsList[$j]['subject_id'] == $subject['subject_id'])
				break;
			if ($i != $j)
			  continue;
			$examsList[$i] = array();  
			$examsList[$i]['subject_id'] = $subject['subject_id'];
			$examsList[$i]['question_id'] = $row['question_id'];
			$examsList[$i]['exam_name'] = $subject['subject_name'];
			$examsList[$i]['exam_date'] = $row['exam_date'];
			$examsList[$i]['exam_id'] = $row['exam_id'];
			$i++;
		}
		return $examsList;
	}
	/** Returns single news items with specified id
	* @rapam integer &id
	*/
	public static function getExamsListByGroupId($group_id)
	{
		$db = Db::getConnection();
		$result = $db->query("SELECT * FROM exams WHERE group_id = '$group_id'");

		$examsList = array();
		$i = 0;
		while ($row = $result->fetch())
		{
			$sub_id = $row['subject_id'];
			$subject = Subjects::getSubjectItemByID($row['subject_id']);
			if (!$subject)
			{
				$result2 = $db->query("SELECT * FROM subjects_archive WHERE subject_id = '$sub_id'");
				$subject = $result2->fetch();
			}
			for ($j = 0; $j < $i; $j++)
			  if ($examsList[$j]['subject_id'] == $subject['subject_id'])
				break;
			if ($i != $j)
			  continue;
			$examsList[$i] = array();  
			$examsList[$i]['subject_id'] = $subject['subject_id'];
			$examsList[$i]['question_id'] = $row['question_id'];
			$examsList[$i]['exam_name'] = $subject['subject_name'];
			$examsList[$i]['exam_date'] = $row['exam_date'];
			$examsList[$i]['exam_id'] = $row['exam_id'];
			$i++;
		}
		return $examsList;
	}

	public static function getGroupsListBySpecId($spec_id)
	{
		$db = Db::getConnection();
		$result = $db->query("SELECT * FROM groups WHERE speciality_id = '$spec_id'");

		$groupsList = array();
		$i = 0;
		while ($row = $result->fetch())
		{
			$groupsList[$i] = array();
			$groupsList[$i]['group_id'] = $row['group_id'];
			$groupsList[$i]['course'] = $row['course'];
			$groupsList[$i]['university'] = $row['university'];
			$groupsList[$i]['department'] = $row['department'];
			$groupsList[$i]['group_num'] = $row['group_num'];
			$i++;
		}
		return $groupsList;
    }
	
	public static function getGroupsItemByID($id)
	{
		$id = intval($id);

		if ($id) {

			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM groups WHERE group_id=' . $id);

			/*$result->setFetchMode(PDO::FETCH_NUM);*/
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$groupsItem = $result->fetch();

			return $groupsItem;
		}

	}

	/**
	* Returns an array of exams items
	*/
	
    public static function getExamsList() 
    {
        $db = Db::getConnection();
        
		$newsList = array();
 
		$result = $db->query('SELECT id, title, date, author_name, short_content FROM news ORDER BY id ASC LIMIT 10');

		$i = 0;
		while($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['author_name'] = $row['author_name'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$i++;
		}

		return $newsList;
	
}

}
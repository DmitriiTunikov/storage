<?php

include_once ROOT. '/models/Instruments.php';
include_once ROOT. '/models/Specialties.php';
include_once ROOT. '/models/Groups.php';
include_once ROOT. '/models/Students.php';
include_once ROOT. '/models/Exams.php';
include_once ROOT. '/models/Subjects.php';
include_once ROOT. '/models/Students.php';


if (!isset($_SESSION))
{
  session_start();
}

class ExamsController 
{
	public function actionWatchBestGroups()
	{
		$db = Db::getConnection();

		$res = $db->query("SELECT groups.group_id AS gr_id, AVG(exams.mark) AS avg_mark FROM (((students INNER JOIN exams ON students.student_id = exams.student_id)
		INNER JOIN study_in ON study_in.student_id = students.student_id) INNER JOIN 
	   groups ON groups.group_id = study_in.group_id) GROUP BY groups.group_id 
	   HAVING AVG(exams.mark) >= 4 ORDER BY AVG(exams.mark) DESC LIMIT 3");
	   $groups = array();
	   $i = 0;
	   while ($row = $res->fetch())
	   {
		   $groups[$i] = array();
		   $groups[$i]['place'] = $i + 1;
		   $groups[$i]['group_id'] = $row['gr_id'];
		   $groups[$i]['mark'] = $row['avg_mark'];
		   $i++;
	   }
	   require_once(ROOT . '/views/exams/watchBestGroups.php');   
	}
	public function actionInputResultExam()
	{
		$_SESSION['speciality_list_reason'] = 'input_result_exam';
		$specialitysList = Specialties::getSpecList();
	    require_once(ROOT . '/views/specialties/drowSpecialtiesList.php');
		return true;	
	}

	public function actionWatchResults()
	{
		$_SESSION['group_list_reason'] = 'watch_results';
		$_SESSION['speciality_list_reason'] = 'watch_result_exam';
		$specialitysList = Specialties::getSpecList();
	    require_once(ROOT . '/views/specialties/drowSpecialtiesList.php');
		return true;
	}

	public function actionCheckExam($exam_id)
	{
		$exam = Exams::getExamsItemByID($exam_id);
		$subject = Subjects::getSubjectItemByID($exam['subject_id']);
		if (!$subject)
		{
			echo "Этот предмет уже удален, по нему нельзя поставить оценку";
			return;
		} 
		$exam_name = $subject['subject_name'];
		$exam_date = $exam['exam_date'];
		$_SESSION['cur_exam'] = $exam;

		$student = $_SESSION['cur_student'];
		//проверить есть ли уже оценка за этот экзамен, если есть то делать UPDATE
		
	    require_once(ROOT . '/views/exams/resultExam.php');
	}

	public function actionAddExam()
	{
		$_SESSION['speciality_list_reason'] = 'add_exam';
		$specialitysList = Specialties::getSpecList();
	    require_once(ROOT . '/views/specialties/drowSpecialtiesList.php');
		return true;	
	}

	public function resultExamToSubject($subject_id)
	{
	}

	public function actionWatchResultsExam($exam_id, $group_id)
	{
		$db = Db::getConnection();
		$exam = Exams::getExamsItemByID($exam_id);
		$group = Groups::getGroupsItemByID($group_id);
		$group_name = $group['course'].$group['university'].$group['department'].'/'.$group['group_num'];
		$subject_id = $exam['subject_id'];
		$result = $db->query("SELECT * FROM exams WHERE subject_id = '$subject_id' and group_id = '$group_id'");
		$subject = Subjects::getSubjectItemByID($subject_id);
		if (!$subject)
		{
			$sub_id = $exam['subject_id'];
			$result2 = $db->query("SELECT * FROM subjects_archive WHERE subject_id = '$sub_id'");
			$subject = $result2->fetch();
		}
		$exam_name = $subject['subject_name'] . $exam['exam_date'];

		$studentsList = array();
		$i = 0;
		while ($row = $result->fetch())
		{
			$studentsList[$i] = array();
			$student = Students::getStudentsItemByID($row['student_id']);
			$studentsList[$i]['student_name'] = $student['student_surname']. ' ' .$student['student_name']. ' '. $student['student_patronymic'];
			$studentsList[$i]['exam_mark'] = Exams::BackMarkChar($row['mark']);
			$i++;
		}
		require_once(ROOT . '/views/exams/drowResults.php');	
	}
	public function actionResultExamToStudent($group_id, $student_id)
	{
		$student = Students::getStudentsItemByID($student_id);
		$examsList = Exams::getExamsListByStudentId($student_id);
		$_SESSION['exams_list_reason'] = 'check_exam';
		require_once(ROOT . '/views/exams/drowExamsList.php');
	}

	public function actionResultExamToGroup($group_id)
	{
		$studentsList = Students::getStudentsListByGroupId($group_id);
		if (empty($studentsList))
		  echo "<font size = '5' color = 'red'><b>В данной группе не учится ни одного студента<b></font>";
		
		require_once(ROOT . '/views/students/drowStudentsList.php');
		return true;
	}

	public function actionAddExamToGroup($group_id)
	{
		$group = Groups::getGroupsItemByID($group_id);
		$spec_id = $group['speciality_id'];
		$subjectList = Subjects::getSubjectsListBySpecId($spec_id);
		if (empty($subjectList))
		{
			echo "<font size = '5' color = 'red'><b>У данной специальности нет предметов, добавьте предмет, потом попробуйте снова<b></font>";
		    return;
		}
		
		require_once(ROOT . '/views/exams/addExam.php');
		return true;
	}

	public function actionResultExamToBase()
    {
		Exams::ResultExamToBase();
	}

	public function actionAddExamToBase()
    {
		Exams::AddExamToBase();
	}

	public function actionWatchExamToGroup()
	{
		$group_id = $_POST['group'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		
		$examsList = Groups::getExamsListByGroupIdInDate($group_id, $start_date, $end_date);
		$_SESSION['watch_group_id'] = $group_id;
		$_SESSION['exams_list_reason'] = 'watch_results';
		$student = '';
		require_once(ROOT . '/views/exams/drowExamsList.php');
	}
	public function actionResultExamToSpec($spec_id, $reason)
	{
		$groupsList = Groups::getGroupsListBySpecId($spec_id);
		if ($reason == 1)
		  $_SESSION['groups_list_reason'] = 'result_exam';
		else if ($reason == 2)
		  $_SESSION['groups_list_reason'] = 'watch_results';
		
 		require_once(ROOT . '/views/groups/drowGroupsList.php');
		return true;
	}

	public function actionAddExamToSpec($spec_id)
	{
		$groupsList = Groups::getGroupsListBySpecId($spec_id);

		$_SESSION['groups_list_reason'] = 'add_exam';
		require_once(ROOT . '/views/groups/drowGroupsList.php');
		return true;
	}
}
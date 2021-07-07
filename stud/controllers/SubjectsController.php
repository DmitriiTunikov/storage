<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

include_once ROOT. '/models/subjects.php';
include_once ROOT. '/models/specialties.php';
include_once ROOT. '/models/themes.php';
include_once ROOT. '/models/questions.php';


class SubjectsController 
{
	public function actionSubjectsInstruments()
	{
        $_SESSION["cur_instrument"] = "Subjects";
        $_SESSION["cur_instrument_rus"] = "предмет";
        
	    require_once(ROOT . '/views/instruments/instruments.php');
		return true;	
	}

	public function actionChangeAcceptedSubject($subject_id)
	{
		$checkedSpec = Subjects::getSubjectSpec($subject_id);
		$specList = Specialties::getSpecList();
		$cur_subject = Subjects::getSubjectItemByID($subject_id);
        $cur_subject_name = $cur_subject['subject_name'];
	    require_once(ROOT . '/views/subjects/changeSubject.php');
	}

	public function actionChangeSubjects()
	{
		$subjectsList = Subjects::getSubjectsList();
		
		$_SESSION['subject_list_reason'] = "change_subject";
		require_once(ROOT . '/views/subjects/drowSubjectsList.php');
		return true;	
    }
	
	public function actionAddSubjects()
	{
		$specList = Specialties::getSpecList();
		
	    require_once(ROOT . '/views/subjects/addSubject.php');
		return true;	
	}
	
	public function actionChangeSubjectToBase()
	{
		$db = Db::getConnection();
		$sub_name = $_POST['subject_name'];
		$subject_id = $_POST['subject_id'];
		
		if (isset($_POST['delete_subject']))
		{
			$themesList = Themes::getThemesListBySubjectId($subject_id);
			$db->query("DELETE FROM subjects WHERE subject_id = '$subject_id'");
			$db->query("INSERT INTO subjects_archive (subject_id, subject_name) VALUES ('$subject_id', '$sub_name')");
			$db->query("DELETE FROM subject_speciality WHERE subject_id = '$subject_id'");
			$db->query("DELETE FROM themes WHERE subject_id = '$subject_id'");
			foreach ($themesList as $themeItem)
			{
				$theme_id = $themeItem['theme_id'];
				$questionsList = Questions::getQuestionsListByThemeId($themeItem['theme_id']);
				$db->query("DELETE FROM questions WHERE theme_id = '$theme_id'");			
				foreach ($questionsList as $questionItem)
				{
					$question_id = $questionItem['question_id'];
					$db->query("UPDATE exams SET question_id = -1 WHERE question_id = '$question_id'");
				}
			}
			echo "Предмет удален";
			return;
		}
		else if (isset($_POST['change_subject']))
		{
			$db->query("UPDATE subjects SET subject_name = '$sub_name' WHERE subject_id = '$subject_id'");
			//insert specialties for new subject
			$checkSpecList = Subjects::getCheckedSpec();
			Subjects::insertSubjectToSpec(0, $checkSpecList, $db, 1, $subject_id);
		}
		$_SESSION["cur_instrument"] = "Subjects";
        $_SESSION["cur_instrument_rus"] = "предмет";
		
		echo "<a href = '/subjects/subjectsInstruments'> Добавить новый предмет </a></br>";
		
		return true;
	}
	public function actionAddSubjectToBase()
	{
		//$db = Db::connect_db();
		$db = Db::getConnection();
		
		if (isset($_POST['add_subject']))
		{
	      //insert new subject to data base
		  $sub_name = $_POST['subject_name'];
		  $db->query("INSERT INTO subjects (subject_name) VALUES ('$sub_name')");
          //insert specialties for new subject
		  $last_id = $db->lastInsertId();
		  $checkSpecList = Subjects::getCheckedSpec();
		  Subjects::insertSubjectToSpec($last_id, $checkSpecList, $db, 0, 0);
		}
		$_SESSION["cur_instrument"] = "Subjects";
        $_SESSION["cur_instrument_rus"] = "предмет";
		
		echo "<a href = '/subjects/addSubjects'> Добавить новый предмет </a></br>";
		
		return true;
	}
}
<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

include_once ROOT. '/models/subjects.php';
include_once ROOT. '/models/themes.php';
include_once ROOT. '/models/specialties.php';
include_once ROOT. '/models/questions.php';


class ThemesController 
{
	public function actionThemesInstruments()
	{
        $_SESSION["cur_instrument"] = "Themes";
        $_SESSION["cur_instrument_rus"] = "тему";
        
	    require_once(ROOT . '/views/instruments/instruments.php');
		return true;	
    }

    public function actionChangeAcceptedTheme($theme_id)
	{
        $checkedSubject = Themes::getThemeSubject($theme_id);
        $subjectList = Subjects::getSubjectsList();
		$cur_theme = Themes::getThemeItemByID($theme_id);
        $cur_theme_name = $cur_theme['theme_name'];
	    require_once(ROOT . '/views/themes/changeTheme.php');
	}

    public function actionChangeAcceptedThemeBySubject($subject_id)
    {
        $themesList = Subjects::getThemesListById($subject_id);

        $_SESSION['themes_list_reason'] = 'change_theme';
        require_once(ROOT . '/views/themes/drowThemesList.php');
		return true;	    
    }

    public function actionAddThemes()
	{
     	$subjectList = Subjects::getSubjectsList();
	    require_once(ROOT . '/views/themes/addTheme.php');
		return true;	
    }
    
    public function actionChangeTheme()
	{   
        $subjectsList = Subjects::getSubjectsList();
        
		$_SESSION['subject_list_reason'] = "change_theme";
	    require_once(ROOT . '/views/subjects/drowSubjectsList.php');
		return true;	
    }

    public function actionChangeThemeToBase()
	{
		$db = Db::getConnection();

		
		if (isset($_POST['delete_theme']))
		{
			$db = Db::getConnection();
			$theme_id = $_POST['theme_id'];
			$questionsList = Questions::getQuestionsListByThemeId($theme_id);
			$db->query("DELETE FROM themes WHERE theme_id = '$theme_id'");
			$db->query("DELETE FROM questions WHERE theme_id = '$theme_id'");			
			foreach ($questionsList as $questionItem)
			{
				$question_id = $questionItem['question_id'];
				$db->query("UPDATE exams SET question_id = -1 WHERE question_id = '$question_id'");
			}
			echo "Тема удалена";
			return;
		}
		if (isset($_POST['change_theme']))
		{
			$theme_name = $_POST['theme_name'];
			$theme_id = $_POST['theme_id'];
			$checkSubjectList = Themes::getCheckedSubject();
			$sub = $checkSubjectList[0];
            $db->query("UPDATE themes SET theme_name = '$theme_name', subject_id = '$sub' WHERE theme_id = '$theme_id'");
        }
		$_SESSION["cur_instrument"] = "Themes";
        $_SESSION["cur_instrument_rus"] = "тему";
		
		echo "<a href = '/subjects/subjectsInstruments'> Добавить новую тему </a></br>";
		
		return true;
	}

    public function actionAddThemeToBase()
	{
		$db = Db::getConnection();
		
		if (isset($_POST['add_theme']))
		{
	      //insert new theme to data base
		  $theme_name = $_POST['theme_name'];
		  $db->query("INSERT INTO themes (theme_name) VALUES ('$theme_name')");
		  
          //insert subject for new theme
		  $last_id = $db->lastInsertId();
          $checkSubjectList = Themes::getCheckedSubject();
		  Themes::insertSubjectToTheme($last_id, $checkSubjectList, $db, 0, 0);
		}
		$_SESSION["cur_instrument"] = "Themes";
        $_SESSION["cur_instrument_rus"] = "тему";
		
		echo "<a href = '/themes/addThemes'> Добавить новую тему </a></br>";
		
		return true;
	}
    
}
?>
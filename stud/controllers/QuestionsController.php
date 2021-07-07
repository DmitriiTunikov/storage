<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

include_once ROOT. '/models/Themes.php';
include_once ROOT. '/models/Questions.php';
include_once ROOT. '/models/Subjects.php';
include_once ROOT. '/models/specialties.php';


class QuestionsController 
{
	public function actionQuestionsInstruments()
	{
        $_SESSION["cur_instrument"] = "Questions";
        $_SESSION["cur_instrument_rus"] = "вопрос";
        
	    require_once(ROOT . '/views/instruments/instruments.php');
		return true;	
    }

    public function actionChangeAcceptedQuestion($question_id)
	{
        $checkedTheme = Questions::getQuestionTheme($question_id);
        $themeList = Themes::getThemesList();
        
        $cur_question = Questions::getQuestionItemByID($question_id);
        $cur_question_name = $cur_question['question_text'];
	    require_once(ROOT . '/views/questions/changeQuestion.php');
	}

    public function actionChangeAcceptedQuestionByTheme($Theme_id)
    {
		$questionsList = Themes::getQuestionsListById($Theme_id);

        require_once(ROOT . '/views/questions/drowQuestionsList.php');
		return true;	    
	}
	
	public function actionAddQuestionToSubject($subject_id)
	{
		$themesList = Themes::getThemesListBySubjectId($subject_id);
		require_once(ROOT . '/views/Questions/addQuestion.php');
		return true;
	}

    public function actionAddQuestion()
	{
		 $subjectsList = Subjects::getSubjectsList();
		 $_SESSION['subject_list_reason'] = 'add_question';
		 require_once(ROOT . '/views/subjects/drowSubjectsList.php');
		 return true;	
    }
	
	public function actionChangeQuestionToSubject($subject_id)
	{
	    $themesList = Themes::getThemesListBySubjectId($subject_id);
        
		$_SESSION['themes_list_reason'] = "change_question";
	    require_once(ROOT . '/views/themes/drowThemesList.php');
		return true;	
	}

    public function actionChangeQuestion()
	{   
		$subjectsList = Subjects::getSubjectsList();
		$_SESSION['subject_list_reason'] = 'change_question';
		require_once(ROOT . '/views/subjects/drowSubjectsList.php');
		return true;	
    }

    public function actionChangeQuestionToBase()
	{
		$db = Db::getConnection();
		
		$Question_name = $_POST['question_name'];
		$Question_id = $_POST['question_id'];

		if (isset($_POST['delete_question']))
		{
			$db->query("DELETE FROM questions WHERE question_id = '$Question_id'");
			$db->query("UPDATE exams SET question_id = -1 WHERE question_id = '$Question_id'");
			echo "Вопрос удален</br>";
			return;
		}
		if (isset($_POST['change_question']))
		{
			$checkThemeList = Questions::getCheckedTheme();
			$theme = $checkThemeList[0];
            $db->query("UPDATE questions SET question_name = '$Question_name', theme_id = '$theme' WHERE question_id = '$Question_id'");
        }
		$_SESSION["cur_instrument"] = "Questions";
        $_SESSION["cur_instrument_rus"] = "вопрос";
		
		echo "<a href = '/questions/questionsInstruments'> Новый вопрос </a></br>";
		
		return true;
	}

    public function actionAddQuestionToBase()
	{
		$db = Db::getConnection();
		
		if (isset($_POST['add_question']))
		{
	      //insert new Question to data base
		  //$question_name = $_POST['question_name'];
		  $question_text = $_POST['question_text'];
		  
          $checkTheme = Questions::getCheckedTheme();
		  $db->query("INSERT INTO questions (question_text, theme_id) VALUES ('$question_text', '$checkTheme')");
		}
		$_SESSION["cur_instrument"] = "Questions";
        $_SESSION["cur_instrument_rus"] = "вопрос";
		
		echo "<a href = '/questions/addQuestions'> Добавить новый вопрос </a></br>";
		
		return true;
	}
    
}
?>
<?php
if (!isset($_SESSION))
{
  session_start();
}

class Exams
{

	/** Returns single news items with specified id
	* @rapam integer &id
	*/
	
	public static function getExamsListByStudentId($student_id)
	{
		$db = Db::getConnection();
		$examsList = array();
		$res = $db->query("SELECT * FROM exams WHERE student_id = '$student_id'");

		$i = 0;
		while ($row = $res->fetch())
		{
			$examsList[$i] = array();
			$examsList[$i]['exam_id'] = $row['exam_id'];
			$examsList[$i]['exam_date'] = $row['exam_date'];
			$examsList[$i]['question_id'] = $row['question_id'];
			
			$subject_id = $row['subject_id'];
			$subjct_res = $db->query("SELECT * FROM subjects WHERE subject_id = '$subject_id'");
			$subject = $subjct_res->fetch();
			$examsList[$i]['exam_name'] = $subject['subject_name'];
			$i++;
		}
		return $examsList;
	}
	public static function AddExamToBase()
	{
		$db = Db::getConnection();
		$questionsList = array();	
		$studentsList = array();
		if (isset($_POST['add_exam']))
		{
		  $group_id = $_POST['group_id'];
		  if (isset($_POST['subject'])) 
			 $subject_id = $_POST['subject'];
		  else
		  {
	    	echo "<font size = '5' color = 'red'><b>Вы не выбрали предмет или у данной специальности нет предметов<b></font>";
		    return;
		  }
		  $date = $_POST['exam_date'];
		}	

		$result = $db->query("SELECT * FROM study_in WHERE group_id = '$group_id'");
		$result_themes = $db->query("SELECT * FROM themes WHERE subject_id = '$subject_id'");
		 
		$result_questions = $db->query("SELECT (question_id) FROM ((themes INNER JOIN subjects ON themes.subject_id = subjects.subject_id) INNER JOIN questions 
		ON questions.theme_id = themes.theme_id) WHERE subjects.subject_id = '$subject_id'");

		$questions_count = 0;
		$themes_count = 0;
		
		/*while($row = $result_themes->fetch())
		{
			$theme_id = $row['theme_id'];
			
			$result_questions = $db->query("SELECT * FROM questions WHERE theme_id = '$theme_id'");
			while ($row1 = $result_questions->fetch())
			{
				$questionsList[$questions_count] = $row1['question_id'];
				$questions_count++;
			}
		}*/
		while ($row1 = $result_questions->fetch())
			{
				$questionsList[$questions_count] = $row1['question_id'];
				$questions_count++;
			}
		if ($questions_count == 0)
		{
		  echo "<font size = '5' color = 'red'><b> Нет вопросов по этому предмету </b></font>";
		  return;
		}

		while ($row = $result->fetch())
		{
		  $student_id = $row['student_id'];
		  $num = rand(0, $questions_count - 1);
		  $question_id = $questionsList[$num];
		  $db->query("INSERT INTO exams (group_id, subject_id, student_id, question_id, exam_date) VALUES ('$group_id', '$subject_id', '$student_id', '$question_id'
		  , '$date')");
		}
		echo "<a href = '/exams/addExam'><font size = '4' color = 'green'><b> Добавить новый экзамен <b></font></br></a>";
	}

	public static function getExamsItemByID($id)
	{
		$id = intval($id);

		if ($id) 
		{
			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM exams WHERE exam_id=' . $id);

			/*$result->setFetchMode(PDO::FETCH_NUM);*/
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$examsItem = $result->fetch();

			return $examsItem;
		}

	}

	/**
	* Returns an array of exams items
	*/

	public static function BackMarkChar($mark)
	{
        if ($mark == 1)
		  return "посредственно";
		else if ($mark == 2)
		  return "удовлетворительно";
		else if ($mark == 3)
		  return "хорошо";
		else if ($mark == 4)
		  return "очень хорошо";
		else if ($mark == 5)
		  return "отлично";
	}

	public static function BackMarkInt($mark)
	{
		if (strcmp($mark, 'отлично') == 0)
		  return 5;
		else if (strcmp($mark, 'очень хорошо') == 0)
		{
			return 4;
		}
		else if (strcmp($mark, 'хорошо') == 0)
		{
			return 3;
		}
		else if (strcmp($mark, 'удовлетворительно') == 0)
		{
			return 2;
		}
		else if (strcmp($mark, 'посредственно') == 0)
		{
			return 1;
		}
	}

	public static function ResultExamToBase() 
	{
		$db = Db::getConnection();
		$exam = $_SESSION['cur_exam'];
		$student = $_SESSION['cur_student'];

		$mark = $_POST['mark'];
		$exam_id = $exam['exam_id'];
		$student_id = $student['student_id'];

		$mark = Exams::BackMarkInt($mark);
		$db->query("UPDATE exams SET mark = '$mark' WHERE exam_id = '$exam_id' and student_id = '$student_id'");
		return true;
	}
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
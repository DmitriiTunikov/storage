<?php

class Questions
{
	public static function getQuestionItemByID($id)
	{
		$id = intval($id);

        if ($id) 
        {
            //$db = Db::connect_db();
		    $db = Db::getConnection();
		    $result = $db->query("SELECT * FROM questions WHERE question_id = '$id'");

			/*$result->setFetchMode(PDO::FETCH_NUM);*/
			$questionsItem = $result->fetch();

			return $questionsItem;
		}
	}
    
    public static function insertThemeToQuestion($last_id, $themeId, $db, $state_change, $Question_id)
    {
        $insertId = array();
        $i = 0;
        
        if (!$state_change)
        {
          $db->query("UPDATE questions SET theme_id = '$themeId' WHERE question_id = '$last_id'");
        }
        else
        {
            $db->query("DELETE FROM question_speciality WHERE question_id = '$Question_id'");
            foreach ($checkSpecList as $specId)
            { 
              $db->query("INSERT INTO question_speciality (question_id, speciality_id) VALUES ('$question_id', '$specId')");
            }
        }   
        return true;
    }

    public static function getQuestionsListByThemeId($theme_id)
    {
        $db = Db::getConnection();
        $res = $db->query("SELECT * FROM questions WHERE theme_id = '$theme_id'");
        $questionsList = array();
        $i =0;
        while ($row = $res->fetch())
        {
            $questionsList[$i] = array();
            $questionsList[$i]['question_id'] = $row['question_id'];
            $questionsList[$i]['question_name'] = $row['question_name'];
            $i++;
        }
        return $questionsList;
    }

    public static function getQuestionTheme($Question_id)
    {
        $db = Db::getConnection();
        $acceptedthemeList = array();
        $result = $db->query("SELECT * FROM questions WHERE question_id = '$Question_id'");
        
        $i = 0;
        while ($row = $result->fetch())
        {
            $acceptedthemeList[$i] = $row['theme_id'];
            $i++;
        }
        return $acceptedthemeList;
    }

    public static function getCheckedTheme() 
    {    
        $db = Db::getConnection();
		
        $result = $db->query("SELECT * FROM themes");
        $i = 0;
        
        if (isset($_POST['theme']))
        {
          $checktheme = $_POST['theme'];
          
          return $checktheme;
        }
    }

    public static function getQuestionsList() 
    {
        //$db = Db::connect_db();
		$db = Db::getConnection();
		
		$questionsList = array();

		$result = $db->query("SELECT * FROM questions");

        $i = 0;
        while($row = $result->fetch())
        {
            $questionsList[$i] = array();
            $questionsList[$i]['question_id'] = $row['question_id'];
            $questionsList[$i]['question_name'] = $row['question_name'];
			$i++;
		}
		return $questionsList;
}
}
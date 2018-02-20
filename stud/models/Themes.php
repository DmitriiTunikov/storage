<?php

class Themes
{
	public static function getThemeItemByID($id)
	{
		$id = intval($id);

        if ($id) 
        {
            //$db = Db::connect_db();
            $db = Db::getConnection();
		    $result = $db->query("SELECT * FROM themes WHERE theme_id = '$id'");

			/*$result->setFetchMode(PDO::FETCH_NUM);*/
			$themesItem = $result->fetch();

			return $themesItem;
		}
	}
    
    public static function insertSubjectToTheme($last_id, $checkSubjectList, $db, $state_change, $Theme_id)
    {
        $insertId = array();
		$i = 0;
        if (!$state_change)
        {
            foreach ($checkSubjectList as $subjectId)
            {
              $db->query("UPDATE themes SET subject_id = '$subjectId' WHERE theme_id = '$last_id'");
            }
        }
        return true;
    }

    
    public static function getThemeSubject($Theme_id)
    {
        $db = Db::getConnection();
        $acceptedSubjectList = array();
        $result = $db->query("SELECT * FROM themes WHERE theme_id = '$Theme_id'");
        
        $i = 0;
        while ($row = $result->fetch())
        {
            $acceptedSubjectList[$i] = $row['subject_id'];
            $i++;
        }
        
        return $acceptedSubjectList;
    }

    public static function getCheckedSubject() 
    {    
        $db = Db::getConnection();
		
		$checkSubjectList = array();

        $result = $db->query("SELECT * FROM subjects");
        $i = 0;
        
        if (isset($_POST['subject']))
        {
          $checkSubjectList[$i] = $_POST['subject'];
        }
        /*while ($row = $result->fetch())
        {
            $subject_id = $row['subject_id'];
            if (isset($_POST["$subject_id"]))
            {
                $checkSubjectList[$i] = $subject_id;
                $i++;
                return $checkSubjectList; 
            }
        }*/
        return $checkSubjectList;
    }

    public static function getThemesListBySubjectId($subject_id) 
    {
        $db = Db::getConnection();
        $res = $db->query("SELECT * FROM themes WHERE subject_id = '$subject_id'");
        $themesList = array();
        $i =0;
        while ($row = $res->fetch())
        {
            $themesList[$i] = array();
            $themesList[$i]['theme_id'] = $row['theme_id'];
            $themesList[$i]['theme_name'] = $row['theme_name'];
            $i++;
        }
        return $themesList;
    }
    public static function getThemesList() 
    {
        //$db = Db::connect_db();
		$db = Db::getConnection();
		
		$themesList = array();

		$result = $db->query("SELECT * FROM themes ORDER BY theme_name");

        $i = 0;
        while($row = $result->fetch())
        {
            $themesList[$i] = array();
            $themesList[$i]['theme_id'] = $row['theme_id'];
            $themesList[$i]['theme_name'] = $row['theme_name'];
			$i++;
		}
		return $themesList;
    }
    public static function getQuestionsListById($Theme_id)
    {
        $db = Db::getConnection();
        $questionsList = array();
        $result = $db->query("SELECT * FROM questions WHERE theme_id = '$Theme_id'");
        
        $i = 0;
        while ($row = $result->fetch())
        {
            $questionsList[$i] = array();
            $questionsList[$i]['question_id'] = $row['question_id'];
            $questionsList[$i]['question_name'] = $row['question_name'];
            $questionsList[$i]['question_text'] = $row['question_text'];
            $questionsList[$i]['theme_id'] = $row['theme_id'];
            $i++;
        }
        return $questionsList;
    }
}
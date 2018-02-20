<?php

class Subjects
{
	public static function getSubjectItemByID($id)
	{
		$id = intval($id);

        if ($id) 
        {
            //$db = Db::connect_db();
		    $db = Db::getConnection();
            $result = $db->query("SELECT * FROM subjects WHERE subject_id = '$id'"); 
            
			/*$result->setFetchMode(PDO::FETCH_NUM);*/
			$subjectsItem = $result->fetch();

			return $subjectsItem;
		}
	}
    

    public static function getThemesListById($subject_id)
    {
        $db = Db::getConnection();
        
        $i = 0;
        $result = $db->query("SELECT * FROM themes WHERE subject_id = '$subject_id'");
        $themesList = array();
        while ($row = $result->fetch())
        {
            $themesList[$i] = array();
            $themesList[$i]['theme_id'] = $row['theme_id'];
            $themesList[$i]['theme_name'] = $row['theme_name'];
            $i++;
        }
        return $themesList;
    }

    public static function insertSubjectToSpec($last_id, $checkSpecList, $db, $state_change, $subject_id)
    {
        $insertId = array();
		$i = 0;
        if (!$state_change)
        {
            foreach ($checkSpecList as $specId)
            { 
              $db->query("INSERT INTO subject_speciality (subject_id, speciality_id) VALUES ('$last_id', '$specId')");
            }
        }
        else
        {
            $db->query("DELETE FROM subject_speciality WHERE subject_id = '$subject_id'");
            foreach ($checkSpecList as $specId)
            { 
              $db->query("INSERT INTO subject_speciality (subject_id, speciality_id) VALUES ('$subject_id', '$specId')");
            }
        }   
        return true;
    }

    public static function getSubjectSpec($subject_id)
    {
        $db = Db::getConnection();
        $acceptedSpecList = array();
        $result = $db->query("SELECT * FROM subject_speciality WHERE subject_id = '$subject_id'");
        
        $i = 0;
        while ($row = $result->fetch())
        {
            $acceptedSpecList[$i] = $row['speciality_id'];
            $i++;
        }
        return $acceptedSpecList;
    }

    public static function getCheckedSpec() 
    {    
        $db = Db::getConnection();
		
		$checkSpecList = array();

        $result = $db->query("SELECT * FROM specialties");
        $i = 0;
        
        while ($row = $result->fetch())
        {
            $spec_id = $row['speciality_id'];
            if (isset($_POST["$spec_id"]))
            {
                $checkSpecList[$i] = $spec_id;
                $i++;
            }
        }
        return $checkSpecList;
    }
    public static function getSubjectsListByGroupId($group_id)
    {
        $subjectsList = array();

        $db = Db::getConnection();
        $res = $db->query("SELECT (speciality_id) FROM groups WHERE group_id = '$group_id'");
        $spec_id = $res->fetch();
        $result = $db->query("SELECT * FROM subject_speciality WHERE speciality_id = '$spec_id'");
        $i = 0;
        while ($row = $result->fetch())
        {
            $subjectsList[$i] = array();
            $subjectsList[$i]['subject_id'] = $row['subject_id'];
            $sub = Subjects::getSubjectItemByID($row['subject_id']);
            $subjectsList[$i]['subject_name'] = $sub['subject_name'];
            $i++;
        }
        if ($i == 0)
            return false;
        return $subjectsList;
    }
    public static function getSubjectsListBySpecId($spec_id) 
    {
        $subjectsList = array();

        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM subject_speciality WHERE speciality_id = '$spec_id'");
        $i = 0;
        while ($row = $result->fetch())
        {
            $subjectsList[$i] = array();
            $subjectsList[$i]['subject_id'] = $row['subject_id'];
            $sub = Subjects::getSubjectItemByID($row['subject_id']);
            $subjectsList[$i]['subject_name'] = $sub['subject_name'];
            $i++;
        }
        if ($i == 0)
          return false;
        return $subjectsList;

    } 
    public static function getSubjectsList() 
    {
        //$db = Db::connect_db();
		$db = Db::getConnection();
		
		$subjectsList = array();

		$result = $db->query("SELECT * FROM subjects ORDER BY subject_name");

        $i = 0;
        while($row = $result->fetch())
        {
            $subjectsList[$i] = array();
            $subjectsList[$i]['subject_id'] = $row['subject_id'];
            $subjectsList[$i]['subject_name'] = $row['subject_name'];
			$i++;
		}
		return $subjectsList;
}
}
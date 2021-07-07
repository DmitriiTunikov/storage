<?php


class Specialties
{
	public static function getSpecItemByID($id)
	{
		$id = intval($id);

		if ($id) 
		{
		    $db = Db::getConnection();
            //$db = Db::getConnection();
			$result = $db->query('SELECT * FROM news WHERE id=' . $id);

			/*$result->setFetchMode(PDO::FETCH_NUM);*/
			//$result->setFetchMode(PDO::FETCH_ASSOC);

			$newsItem = $result->fetch_assoc();

			return $newsItem;
		}

	}

	/**
	* Returns an array of specs items
	*/
	public static function getSpecList() {

		//$db = Db::connect_db();
		$db = Db::getConnection();
		$specList = array();
		
		if (!$db)
		{
		  echo "dssda";
		  return;
		}
		$result = $db->query("SELECT * FROM specialties ORDER BY speciality_name");
		if (!$result)
		{
			echo "2";
			return;
		}
        $i = 0;
  
        while($row = $result->fetch())
        {
			$spesList[$i] = array();

            $specList[$i]['speciality_id'] = $row['speciality_id'];
			$specList[$i]['speciality_name'] = $row['speciality_name'];
			$i++;
		}
		
		return $specList;
}
}
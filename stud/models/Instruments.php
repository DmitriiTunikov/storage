<?php


class Instruments
{
	public static function getInstrumentItemByID($id)
	{
		$id = intval($id);

		if ($id) 
		{
			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM instruments WHERE id=' . $id);

			$result->setFetchMode(PDO::FETCH_ASSOC);

			$newsItem = $result->fetch();

			return $newsItem;
		}
	}

	/**
	* Returns an array of instruments items
	*/
	public static function getInstrumentsList() 
	{
		$db = Db::getConnection();
		$newsList = array();

		$result = $db->query('SELECT * FROM instruments');
		$i = 0;
		while(($row = $result->fetch_assoc()) == true) 
		{
			$instrumentsList[$i]['instrument_id'] = $row['instrument_id'];
			$newsList[$i]['instrument_name'] = $row['instrument_name'];
			$i++;
		}
		return $instrumentsList;
    }
}
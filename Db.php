<?php

class Db
{
	public static function connect_db()
	{
	   $mysqli = new mysqli("localhost", "root", "", "storage");
		  
	  header("Content-Type: text/html; charset=UTF-8"); // Где-нибудь в начале PHP скрипта
	  $mysqli->query( "SET CHARSET utf8" );
  
	  if ($mysqli->connect_errno == true)
	  { 
		  var_dump($mysqli->connect_errno);
		  echo "call admin";
	  }
	  return $mysqli;
	}

		public static function getConnection()
		{
			$paramsPath = ROOT . '/config/db_params.php';
			$params = include($paramsPath);


			$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
			$db = new PDO($dsn, $params['user'], $params['password'],
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

			return $db;
		}
}
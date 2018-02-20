<?php
if (!isset($_SESSION))
{
  session_start();
}

class Users
{
    public static function FindUserByLogin($login)
	{
        $db = Db::connect_db();

        $res = $db->query('SELECT * FROM users');

        while(($row = $res->fetch()))
        {
            if (strcmp($row['login'], $login) == 0)
              return $row;            
        }
        return 0;
    }
}
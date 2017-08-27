<html>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
//подключение в базе данных
  function connect_db()
  {
     $mysqli = new mysqli("92.53.124.109", "root", "zyDiNJe8", "storage");
        
    header("Content-Type: text/html; charset=UTF-8"); // Где-нибудь в начале PHP скрипта
    $mysqli->query( "SET CHARSET utf8" );

    if ($mysqli->connect_errno == true)
    { 
        echo "call admin";
    }
    return $mysqli;
  }
  
  function connect_db_orders()
  {
    $mysqli = new mysqli("92.53.124.109", "root", "zyDiNJe8", "storage");
        
    //header("Content-Type: text/html; charset=UTF-8"); // Где-нибудь в начале PHP скрипта
    $mysqli->query( "SET CHARSET utf8" );
    if ($mysqli->connect_errno == true)
    { 
        echo "call admin";
    }
    return $mysqli;
  }
?>
</body>
</html>
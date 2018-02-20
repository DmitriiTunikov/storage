<html>
  <body>
<?php 
//подключение в базе данных
  include_once "connect.php";
  include_once "help_func.php";
  include_once "enter.php";
  
  $mysqli = connect_db();
    
//  AddUser("sdsd", "dsd", "2312");
  /*$idd =  GetId("dsd"); 
  if ($idd)
  {
    UpdateUser($idd, "123", "qwerty", "new_user");
  }*/
  
  $result = $mysqli->query("SELECT * FROM users");
  
  while (($users_data = $result->fetch_assoc()) == true)
  {
    print_r($users_data);     
    echo "<br/>";
  }
 
?>
</body>
</html>

<?php
  include_once "connect.php";
  include_once "drow_func.php";
  
  $db = connect_db();
  $result = $db->query("SELECT * FROM tovars");
  $id = $_POST['sub'];

  $tovar = "";
  $color = "";
  $prize = 0;

  while (($cur_order = $result->fetch_assoc()) == true)
  {
      if ($cur_order['id'] == $id)
      {
          $tovar = $cur_order['Название'];
          $color = $cur_order['Цвет'];
          $prize = $cur_order['Цена'];
      }
  }

  $db->query("INSERT INTO cur_tovar (Название, Цвет, Цена) VALUES ('$tovar', '$color', '$prize')");

  drow_tovars_table(1);
?>
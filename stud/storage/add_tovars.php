<style>body { background: url(../in1.jpg); }</style>

<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}
  include_once "connect.php";
  include_once "drow_func.php";
  include_once "help_func.php";

  $db = connect_db();
  $result = $db->query("SELECT * FROM sklad_moll");
  $id = $_POST['sub'];
  
  $_SESSION['cur_art']++;
  $num = $_SESSION['cur_art'];

  $_SESSION["art_mas"."$num"] = $id;
  
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
  
  $name = back_base_name();

  $db->query("INSERT INTO $name (Название, Цвет, Цена) VALUES ('$tovar', '$color', '$prize')");
  
  storage_classes("товары");
  drow_tovars_table("Все товары");
?>
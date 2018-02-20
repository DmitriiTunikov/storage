<?php
include_once "connect.php";
include_once "excel_work.php";

function AddTovar($name, $art, $color, $prize, $have_count)
{
      $db = connect_db_orders();

      $db->query("INSERT INTO sklad_moll (название, артикул, цвет, цена, наличие) VALUES ('$name', '$art', '$color', '$prize', '$have_count')"); 
}

$doc = GetDoc("D:/files/20.07.2017.xls", 0);
$name = "";
$art = "";
$color = "";
$prize = 0;
$have_count = "";
for ($i = 2; $i < 53; $i++)
{
  $name = $doc[$i][0];
  $color = $doc[$i][1];
  $have_count = $doc[$i][5];
  AddTovar($name, $art, $color, $prize, $have_count);
}
?>
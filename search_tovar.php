<html>



<style>
  body { background: url(in.jpg); }
</style>

<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
include_once "connect.php";

if (isset($_POST['search_tovar']))
{
    echo "<a href = 'tovars_table.php'> <b><font size = '5'color = 'black'/> Все товары </b></a><br>";
    echo "<a href = 'back_to_order.php'> <b><font size = '5'color = 'black'/> Вернуться к заказу </b></a><br>";
        $db = connect_db();

      $result = $db->query("SELECT * FROM tovars");
      $needToContinue = 0;

      $arr = array();
      $search_str = $_POST['name'];

         echo "<html>
    <body>
    <table border = '1' bgcolor = '00ff7f' align = 'center'>
    <thead >
    <th> № </th>
    <th> Название </th>
    <th> Цвет </th>
    <th> Цена </th>
    <th> Добавить </th>
    </thead>
    <tbody>";
    $i = 0; 
    $id = 0;
    echo "<form method = post action = 'add_tovars.php' align = 'right' autocomplete = 'off'>";
      while (($cur_order = $result->fetch_assoc()) == true)
      {
          $str = $cur_order['Название'];

          if((stristr($str, $search_str)) != false)
          {
                  $id = $cur_order['id'];
                  echo "<tr> <td>".$cur_order['id']."</td>";
                  echo "<td>".$cur_order['Название']."</td>";
                  echo "<td>".$cur_order['Цвет']."</td>";
                  echo "<td>".$cur_order['Цена']."</td>";
                  echo "<td><input type = submit name = 'sub' value = $id></td></tr>";
          }
      }
}
if (isset($_POST['search']))
{
    echo "<form method = post action = 'search_tovar.php' align = 'right' autocomplete = 'on'>
    <input name = 'name' placeholder = 'наименование'>
    <input type = submit name = 'search' value = 'Поиск'></form>";
  echo "<h1 align = 'center'> Склад </h1>
  <a href = 'main.php'> <b><font size = '5' color = 'black'/> Главная </b></a><br>
    <a href = 'Storage.php'> <b><font size = '5'color = 'black'/> Все товары </b></a><br>";
      $db = connect_db();

      $result = $db->query("SELECT * FROM sklad_moll");
      $needToContinue = 0;

      $arr = array();
      $search_str = $_POST['name'];

         echo "<html>
    <body>
    <table border = '1' bgcolor = '00ff7f' align = 'center'>
    <thead >
    <th> № </th>
    <th> Название </th>
    <th> Цвет </th>
    <th> Цена </th>
    <th> В наличии </th>
    <th> Доп.инфо </th>
    <th> Инструменты </th>
    </thead>
    <tbody>";
      $i = 0; 
      echo "<form action = 'change_storage_2.php' method = post>"; 
      while (($cur_order = $result->fetch_assoc()) == true)
      {
          $num = $cur_order['id'];
          $str = $cur_order['Название'];

          if((stristr($str, $search_str)) != false)
          {
            echo "<tr> <td>".$cur_order['id']."</td>";
            echo "<td>".$cur_order['Название']."</td>";
            echo "<td>".$cur_order['Цвет']."</td>";
            echo "<td>".$cur_order['Цена']."</td>";
            echo "<td>".$cur_order['Наличие']."</td>";
            echo "<td>".$cur_order['Поставка']."</td>";
            echo "<td>".$cur_order['доп_инфо']."</td>";
            if ($_SESSION["login"] == "elena98")
              echo "<td><input type = submit name = 'change$num' value = 'изменить'><input type = submit name = 'delete$num' value = 'удалить'></td>";
          }
      }
}
?>
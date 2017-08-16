<?php
include_once "connect.php";

if (isset($_POST['search_tovar_prize']))
{
        echo "<style>
  body { background: url(in1.jpg); }
</style>";
  echo "<h1 align = 'center'> Прайс </h1>
  <a href = 'main.php'> <b><font size = '5' color = 'black'/> Главная </b></a><br>
    <a href = 'tovar_table_2.php'> <b><font size = '5'color = 'black'/> Все товары </b></a><br>";
      $db = connect_db();

      $result = $db->query("SELECT * FROM tovars");
      $needToContinue = 0;

      $arr = array();
      $search_str = $_POST['name'];

         echo "<html>
    <body>
    <table border = '1' bgcolor = 'AFEEEE' align = 'center'>
    <thead >
    <th> № </th>
    <th> Название </th>
    <th> Цвет </th>
    <th> Цена </th>
    </thead>
    <tbody>";
      $i = 0; 
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
          }
      }
}
?>
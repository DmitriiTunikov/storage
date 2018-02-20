<?php
include_once "connect.php";

drow_tovars_table_2();
function drow_tovars_table_2()
{
    include_once "connect.php";
      echo "<h1 align = 'center'> Прайс </h1>
  <a href = 'main.php'> <b><font size = '5' color = 'black'/> Главная </b></a><br>";
    echo "<style>
  body { background: url(in1.jpg); }
</style>";
    echo "<form method = post action = 'search_tovar_prize.php' align = 'right' autocomplete = 'on'>
    <input name = 'name' placeholder = 'наименование'>
    <input type = submit name = 'search_tovar_prize' value = 'Поиск товара'></form>";
     echo "<html>
    <body>
    <table border = '1' bgcolor = 'AFEEEE' align = 'center'>
    <thead >
    <th> № </th>
    <th> Наименование </th>
    <th> Цвет </th>
    <th> Цена </th>
    </thead>
    <tbody>";
        $db = connect_db_orders();
        $result = $db->query("SELECT * FROM tovars");
    
        while (($cur_order = $result->fetch_assoc()) == true)
        {  
            
                  $id = $cur_order['id'];
        echo "<tr> <td>".$cur_order['id']."</td>";
        echo "<td>".$cur_order['Название']."</td>";
        echo "<td>".$cur_order['Цвет']."</td>";
        echo "<td>".$cur_order['Цена']."</td>";
        }
        echo "</form>";
        echo "</tbody>
        </table>
    </body>
    </html>";
}
?>
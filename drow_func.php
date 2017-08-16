<!DOCTYPE HTML>
<html>
<?php    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
function drow_tovars_table($is_first_come)
{
    include_once "connect.php";
    echo "<a href = 'back_to_order.php'> <b><font size = '5'color = 'black'/> Вернуться к заказу </b></a><br>";

    echo "<style>
  body { background: url(in1.jpg); }
</style>";
    echo "<form method = post action = 'search_tovar.php' align = 'right' autocomplete = 'on'>
    <input name = 'name' placeholder = 'наименование'>
    <input type = submit name = 'search_tovar' value = 'Поиск товара'></form>";
     echo "<html>
    <body>
    <table border = '1' bgcolor = '00ff7f' align = 'center'>
    <thead >
    <th> № </th>
    <th> Наименование </th>
    <th> Цвет </th>
    <th> Цена </th>
    <th> Добавить </th>
    </thead>
    <tbody>";
    echo "<form method = post action = 'add_tovars.php' align = 'right' autocomplete = 'off'>";
        $db = connect_db_orders();
        $result = $db->query("SELECT * FROM tovars");
    
        while (($cur_order = $result->fetch_assoc()) == true)
        {  
            
                  $id = $cur_order['id'];
        echo "<tr> <td>".$cur_order['id']."</td>";
        echo "<td>".$cur_order['Название']."</td>";
        echo "<td>".$cur_order['Цвет']."</td>";
        echo "<td>".$cur_order['Цена']."</td>";
        echo "<td><input type = submit name = 'sub' value = $id></td></tr>";
        }
        echo "</form>";
        echo "</tbody>
        </table>
    </body>
    </html>";
}

function drow_change_form($id ,$name, $color, $haveit, $dopinf)
{
echo "<form action = 'change_storage.php' method= post autocomplete = 'off'>
    <p><input name='id' placeholder='Номер' value = '$id'/></p>
    <p><input name='Название' placeholder='Наименование' value = '$name'/></p>
    <p><input name='Цвет' placeholder='Цвет' value = '$color'/></p>
    <p><input name='Наличие' placeholder='Наличие' value = '$haveit'/></p>
    <p><input name='доп_инфо' placeholder='Доп.Инфо' value = '$dopinf'/></p>
    <input type = submit name = 'change_tovar_to_storage' value = 'изменить товар'/>
</form>";
}

function drow_adding_form()
{
echo "<form action = 'change_storage.php' method= post autocomplete = 'off'>
    <p><input name='id' placeholder='Номер'/></p>
    <p><input name='Название' placeholder='Наименование'/></p>
    <p><input name='Цвет' placeholder='Цвет'/></p>
    <p><input name='Наличие' placeholder='Наличие'/></p>
    <p><input name='доп_инфо' placeholder='Доп.Инфо'/></p>
    <input type = submit name = 'add_tovar_to_storage' value = 'добавить товар'/>
</form>";
}

function drow_storage_table()
{
include_once "connect.php";
    echo "<form method = post action = 'search_tovar.php' align = 'right' autocomplete = 'on'>
    <input name = 'name' placeholder = 'наименование'>
    <input type = submit name = 'search' value = 'Поиск'></form>";
     echo "<html>
    <body>
    <table border = '1' bgcolor = 'AFEEEE' align = 'center'>
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
        $db = connect_db_orders();
        $result = $db->query("SELECT * FROM sklad_moll");
    echo "<form action = 'change_storage_2.php' method = post>"; 
        while (($cur_order = $result->fetch_assoc()) == true)
        {  
            $num = $cur_order['id'];
        echo "<tr> <td>".$cur_order['id']."</td>";
        echo "<td>".$cur_order['Название']."</td>";
        echo "<td>".$cur_order['Цвет']."</td>";
        echo "<td>".$cur_order['Цена']."</td>";
        echo "<td>".$cur_order['Наличие']."</td>";
        echo "<td>".$cur_order['Поставка']."</td>";
        echo "<td>".$cur_order['Категория']."</td>";
        echo "<td>".$cur_order['доп_инфо']."</td>";
        
        if ($_SESSION["login"] == "elena98")
        {
          echo "<td><input type = submit name = 'change$num' value = 'изменить'><input type = submit name = 'delete$num' value = 'удалить'></td>";
        }

        }
        
        echo "</form></tbody>
        </table>
    </body>
    </html>";
}

function drow_orders_table($state)
{
include_once "connect.php";
    echo "  <style type='text/css'>
  .orders { 
    width: 500px; 
    background: #00f000;
    padding: 200px;
    padding-right: 25px; 
    border: solid 1px orange; 
   }
   .forms{
       padding-right: 200px;
   }
  </style>
        <form action = 'change_order.php' method = post align = 'right' autocomplete = 'off'>
        <input name = 'id' placeholder = 'номер заказа'/>
        <input type=submit name = 'delete' value = 'удалить'/>
        <input type=submit name = 'change' value = 'изменить'/>
        <input type=submit name = 'save' value = 'сохранить'/></br></br>
        <input type=submit name = 'add_to_payd' value = 'добавить в оплаченные'/>
        <input type=submit name = 'add_to_delivered' value = 'добавить в доставленные'/>
        </form>";
    echo "<html>
        <body>";
    if ($state == "не оплачен")
    {
      echo "<table border = '1' bgcolor = 'AFEEEE' align = 'center'>";
    }
    else if ($state == "оплачен")
    {
       echo "<table border = '1' bgcolor = 'F0E68C' align = 'center'>";    
    }
    else if ($state == "доставлен")
    {
       echo "<table border = '1' bgcolor = '90EE90' align = 'center'>";       
    }
    echo "
    <thead >
    <th> № </th>
    <th> заказчик </th>
    <th> дата создания </th>
    <th> телефон </th>
    <th> продавец </th>
    <th> адрес доставки </th>
    <th> товары </th>
    <th> сумма </th>
    <th> оплачено </th>
    <th> менеджер </th>
    <th> доп. инфо </th>
    <th> состояние </th>
    </thead>
    <tbody>";
    function drow_table($database, $state)
    {
        $db = connect_db_orders();
        $result = $db->query("SELECT * FROM $database WHERE состояние = '$state'"); 

        while (($cur_order = $result->fetch_assoc()) == true)
        {  
        echo "<tr> <td>".$cur_order['id']."</td>";
        echo "<td>".$cur_order['заказчик']."</td>";
        echo "<td>".$cur_order['дата']."</td>";
        echo "<td>".$cur_order['телефон']."</td>";
        echo "<td>".$cur_order['продавец']."</td>";
        echo "<td>".$cur_order['адрес_доставки']."</td>";
        echo "<td>".$cur_order['товары']."</td>";
        echo "<td>".$cur_order['сумма']."</td>";
        echo "<td>".$cur_order['оплачено']."</td>";
        echo "<td>".$cur_order['менеджер']."</td>";
        echo "<td>".$cur_order['доп_инфо']."</td>";
        echo "<td>".$cur_order['состояние']."</td>
        </tr>";
        }
    }
        if ($_SESSION["login"] == "elena98" && $_SESSION["page"] == "ip")
        {
           drow_table("orders", $state);
           drow_table("orders_mh", $state);
           drow_table("orders_garden", $state);
           //drow_table("orders_td", $state);
        }
        else if ($_SESSION["page"] == "ip")
        {
            $db_name = $_SESSION["name"];
            drow_table($db_name, $state);
        }
        else
        {
            drow_table("orders_td", $state);
        }
        echo "</tbody>
        </table>";
        echo "</body></html>";
}
?>
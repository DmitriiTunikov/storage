<!DOCTYPE HTML>
<html>
<style>
   .layer10 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 200px; /* Положение от нижнего края */
    left: 320; /* Положение от правого края */
   }
 .sent {
    position: absolute; 
    top: 50px; /* Положение от нижнего края */
    left: 600px; /* Положение от правого края */
   }
</style>
<?php    
include_once "help_func.php";

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
function drow_tovars_table($search_str)
{
    include_once "connect.php";

if ($search_str == "Все товары")
{
    echo "<a href = 'back_to_order.php'> <b><font size = '5'color = 'black'/> Вернуться к заказу </b></a><br>";
    echo "<form method = post action = 'search_tovar.php' align = 'right' autocomplete = 'on'>
    <input name = 'name' placeholder = 'наименование'>
    <input type = submit name = 'search_tovar' value = 'Поиск товара'></form>";
}
else
{
    echo "<a href = '../back_to_order.php'> <b><font size = '5'color = 'black'/> Вернуться к заказу </b></a><br>";
    echo "<form method = post action = '../search_tovar.php' align = 'right' autocomplete = 'on'>
    <input name = 'name' placeholder = 'наименование'>
    <input type = submit name = 'search_tovar' value = 'Поиск товара'></form>";
}
     echo "<html>
    <body>
    <div class = 'layer10'>
    <table border = '1' bgcolor = 'AFEEEE' align = 'center'>
    <thead >
    <th> № </th>
    <th> Наименование </th>
    <th> Цвет </th>
    <th> Цена </th>
    <th> Наличие </th>
    <th> Поставка </th>
    <th> Категория </th>
    <th> Доп.инфо </th>
    <th> Добавить </th>
    </thead>
    <tbody>";
    if ($search_str == "Все товары")
      echo "<form method = post action = 'add_tovars.php' align = 'right' autocomplete = 'off'>";
    else
      echo "<form method = post action = '../add_tovars.php' align = 'right' autocomplete = 'off'>";
        $db = connect_db_orders();
        $result = $db->query("SELECT * FROM sklad_moll");
    
        while (($cur_order = $result->fetch_assoc()) == true)
        {  
            if ($search_str == "Все товары" ||$search_str == $cur_order['Категория'])
            {
            $id = $cur_order['id'];

            echo "<tr> <td>".$cur_order['id']."</td>";
            echo "<td>".$cur_order['Название']."</td>";
            echo "<td>".$cur_order['Цвет']."</td>";
            echo "<td>".$cur_order['Цена']."</td>";
            if ($_SESSION["second_name"] == "orders_elena" || $cur_order['Наличие'] < 4){
                echo "<td>".$cur_order['Наличие']."</td>";
              }
              else
              {
                  echo "<td> Есть </td>";
              }

              if ($_SESSION["second_name"] == "orders_elena" || $cur_order['Поставка'] < 4)
              {
                  echo "<td>".$cur_order['Поставка']."</td>";
              }
              else
              {
                  echo "<td> Есть </td>";
              }
            echo "<td>".$cur_order['Категория']."</td>";
            echo "<td>".$cur_order['доп_инфо']."</td>";

            echo "<td><input type = submit name = 'sub' value = $id></td></tr>";
            }
        }
        echo "</form>";
        echo "</tbody>
        </table>
        </div>
    </body>
    </html>";
}

function drow_change_form($id ,$name, $color, $prize, $haveit, $next, $dopinf, $categ)
{
echo "<form action = 'change_storage.php' method= post autocomplete = 'off'>
    <p><input name='id' placeholder='Номер' value = '$id'/>Номер товара</p>
    <p><input name='newid' placeholder='Новый Номер'/>Новый Номер товара</p>
    <p><input name='Название' placeholder='Наименование' value = '$name'/>Название</p>
    <p><input name='Цвет' placeholder='Цвет' value = '$color'/>Цвет</p>
    <p><input name='Цена' placeholder='Цена' value = '$prize'/>Цена</p>
    <p><input name='Наличие' placeholder='Наличие' value = '$haveit'/>Наличие</p>
    <p><input name='Поставка' placeholder='Поставка' value = '$next'/>Поставка</p>
    <p><input name='Категория' placeholder='Категория' value = '$categ'/>Категория</p>
    <p><input name='доп_инфо' placeholder='Доп.Инфо' value = '$dopinf'/>Доп.инфо</p>

    <input type = submit name = 'change_tovar_to_storage' value = 'изменить товар'/>
</form>";
}

function drow_adding_form()
{
echo "<form action = 'change_storage.php' method= post autocomplete = 'off'>
    <p><input name='id' placeholder='Номер'/></p>
    <p><input name='Название' placeholder='Наименование'/></p>
    <p><input name='Цвет' placeholder='Цвет'/></p>
    <p><input name='Цена' placeholder='Цена'/></p>
    <p><input name='Наличие' placeholder='Наличие'/></p>
    <p><input name='Поставка' placeholder='Поставка'/></p>
    <p><input name='Категория' placeholder='Категория'/></p>
    <p><input name='доп_инфо' placeholder='Доп.Инфо'/></p>
    <input type = submit name = 'add_tovar_to_storage' value = 'добавить товар'/>
</form>";
}

function drow_storage_table($category)
{
include_once "connect.php";
    if ($category == "товары")
    {
            echo "<form method = post action = 'search_tovar.php' align = 'right' autocomplete = 'on'>";
    }
    else
            echo "<form method = post action = '../search_tovar.php' align = 'right' autocomplete = 'on'>";
         echo"<input name = 'name' placeholder = 'наименование'>
    <input type = submit name = 'search' value = 'Поиск'></form><html>
    <body>
    <table border = '1' bgcolor = 'AFEEEE' align = 'center'>
    <thead >
    <th> № </th>
    <th> Название </th>
    <th> Цвет </th>
    <th> Цена </th>
    <th> В наличии </th>
    <th> Поставка </th>
    <th> Категория </th>
    <th> Доп.инфо </th>
    <th> Инструменты </th>
    </thead>
    <tbody>";
        $db = connect_db_orders();
        $result = $db->query("SELECT * FROM sklad_moll");
        if ($category == "товары")
        {
    echo "<form action = 'change_storage_2.php' method = post>";
        }
        else
           echo "<form action = '../change_storage_2.php' method = post>";
        while (($cur_order = $result->fetch_assoc()) == true)
        {  
            if ($category == "товары" || $cur_order['Категория'] == $category)
            {
                    $num = $cur_order['id'];
                echo "<tr> <td>".$cur_order['id']."</td>";
                echo "<td>".$cur_order['Название']."</td>";
                echo "<td>".$cur_order['Цвет']."</td>";
                echo "<td>".$cur_order['Цена']."</td>";
                if ($_SESSION["second_name"] == "orders_elena" || $cur_order['Наличие'] < 4){
                  echo "<td>".$cur_order['Наличие']."</td>";
                }
                else
                {
                    echo "<td> Есть </td>";
                }

                if ($_SESSION["second_name"] == "orders_elena" || $cur_order['Поставка'] < 4)
                {
                    echo "<td>".$cur_order['Поставка']."</td>";
                }
                else
                {
                    echo "<td> Есть </td>";
                }
                echo "<td>".$cur_order['Категория']."</td>";
                echo "<td>".$cur_order['доп_инфо']."</td>";
                
                if ($_SESSION["login"] == "elena98")
                {
                    echo "<td><input type = submit name = 'change$num' value = 'изменить'><input type = submit name = 'delete$num' value = 'удалить'></td>";
                }
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
    <th> телефон2 </th>
    <th> продавец </th>
    <th> адрес доставки </th>
    <th> лифт </th>
    <th> этаж </th>
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
        echo "<td>".$cur_order['телефон2']."</td>";
        echo "<td>".$cur_order['продавец']."</td>";
        echo "<td>".$cur_order['адрес_доставки']."</td>";
        echo "<td>".$cur_order['лифт']."</td>";
        echo "<td>".$cur_order['этаж']."</td>";
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
function drow_tovars()
{
        for ($i = 1; $i <= 10; $i++)
    {
    echo "<input name = 'товар$i' placeholder= 'товар №$i'/>
    <input name = 'цвет$i' placeholder = 'цвет'/>
    <input name = 'количество$i' placeholder = 'количество'/>
    <input name = 'цена$i' placeholder = 'цена'/>
    <input name = 'скидка$i' placeholder = 'скидка'/>
    <br>";    
    }
}

function drow_first_form($manager_name)
{
    echo "<div class = 'sent'> <a href = 'main.php'> Вернуться на главную </a></div>";
      echo"  <p><input name='id' placeholder='Номер'/>Номер</p>
    <p><input name='заказчик' placeholder='Заказчик'/>Заказчик</p>
    <p><input name='адрес' placeholder='Адрес'/>Адрес</p>
    <p><input type = radio name='лифт'/>Лифт</p>
    <p><input name='этаж' placeholder='этаж'/>Этаж</p>
    <p><input name='телефон' placeholder='Телефон'/>Телефон
    <input name='телефон2' placeholder='Телефон'/>Телефон</p>
    <p><input name='менеджер' placeholder='Менеджер' value = '$manager_name'/>Менеджер</p>";
}

function drow_second_form()
{
        echo "<input type = submit name = 'add_tovar' value = 'добавить товар'/>";
    echo "<p><input name='общая_скидка' placeholder='Общая скидка'></p>
    <p><input name='оплачено' placeholder='Оплачено'/></p>
    <p><input name='доп_инфо' placeholder='Доп.инфо'/></p>
        <p><select name = 'состояние'>
  <option>не оплачен</option>
  <option>оплачен</option>
</select></p>
    <input type=submit name = 'add_order' value = 'Сделать предрассчет'/>";
}

function drow_form_full($id, $orderer, $adress, $lift, $level, $telephone, $telephone2, $manager, $tovarMas, $colorMas, $countMas, 
$prizeMas, $saleMas, $sale, $payd, $dopinf, $state)
{    
    echo "<div class = 'sent'> <a href = 'main.php'> Вернуться на главную </a></div>";
        echo "<form method='post' autocomplete = 'off' action = 'ScoreNewOrder.php'>
    <p><input name='id' placeholder='Номер' value = '$id'/>Номер</p>
    <p><input name='заказчик' placeholder='Заказчик' value = '$orderer'/>Заказчик</p>
    <p><input name='адрес' placeholder='Адрес'value = '$adress'/>Адрес</p>";
    if ($lift != "")
      echo "<p><input type = radio name='лифт' checked/>Лифт</p>";
    else
      echo "<p><input type = radio name='лифт' checked/>Лифт</p>";
    echo"<p><input name='этаж' placeholder='Этаж' value = '$level'/>Этаж</p>
    <p><input name='телефон' placeholder='Телефон' value = '$telephone'/>Телефон
    <input name='телефон2' placeholder='Телефон' value = '$telephone2'/>Телефон</p>
    <p><input name='менеджер' placeholder='Менеджер' value = '$manager'/>Менеджер</p>
    <div style = 'float: left;'>";
    for ($i = 1; $i <= 10; $i++)
    {
    echo "<input name = 'товар$i' placeholder= 'товар №$i' value = '$tovarMas[$i]'/>
    <input name = 'цвет$i' placeholder = 'цвет' value = '$colorMas[$i]'/>
    <input name = 'количество$i' placeholder = 'количество' value = '$countMas[$i]'/>
    <input name = 'цена$i' placeholder = 'цена' value = '$prizeMas[$i]'/>
    <input name = 'скидка$i' placeholder = 'скидка'  value = '$saleMas[$i]'/>
    <br>";    
    }
    echo "<input type = submit name = 'add_tovar' value = 'добавить товар'/>";
    $sum = 0;
    $full_order = 0;
    $sum = ScoreSum() * ((100 - $_POST['общая_скидка']) / 100);

    echo "<p><input name='общая_скидка' placeholder='Общая скидка' value = '$sale'>Скидка</p>
    <p><input name='сумма' placeholder='сумма' value = '$sum'> Сумма заказа</p>
    <p><input name='оплачено' placeholder='Оплачено' value = '$payd'/>Оплачено</p>
    <p><input name='доп_инфо' placeholder='Доп.инфо' value = '$dopinf'/>Доп.Инфо</p>
        <p><select name = 'состояние' value = '$state'>
  <option>не оплачен</option>
  <option>оплачен</option>
  <option selected value = '$state'>$state</option>
</select></p>";
}
?>
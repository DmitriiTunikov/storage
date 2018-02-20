<!DOCTYPE HTML>
<html>
<a href = 'main.php'><font size = "5" color = 'green'/><b> Вернуться на главную </font></b></a>
<h1 align = 'center'>
Архив</h1>
<style>
  body { background: url(in3.jpg); }
</style>
    <body>
<?php
  include_once "connect.php";
  if (isset($_POST['regenerate']))
    {
        $db2 = connect_db_orders();
        $result = $db2->query("SELECT * FROM archive");

        $needToContinue = 0;
        $idd = $_POST['id']; 

        while (($cur_order = $result->fetch_assoc()) == true)
        {
            if ($cur_order['id'] == $idd)  
            {
                $needToContinue = 1;
                $db1 = connect_db();
                $id = $cur_order['id'];
                $orderer = $cur_order['заказчик'];
                $date = $cur_order['дата'];
                $adress = $cur_order['адрес_доставки'];
                $telephone = $cur_order['телефон'];
                $manager = $cur_order['менеджер'];
                $sum1= $cur_order['сумма'];
                $tovar = $cur_order['товары'];
                $sale = $cur_order['скидка'];
                $payd = $cur_order['оплачено'];
                $dopinf = $cur_order['доп_инфо'];
                if (!isset($_SESSION))
              {
                session_start();
              }
      
                $data_base = "";
                $data_base = $_SESSION["name"];
                $db1->query("INSERT INTO $data_base (id, заказчик, дата, адрес_доставки, телефон, товары ,менеджер, сумма, скидка, доп_инфо, оплачено) VALUES('$id', '$orderer', '$date', '$adress', 
                '$telephone','$tovar', '$manager', '$sum1', '$sale', '$dopinf', '$payd')");
            }
        }
        if (!$needToContinue)
        {
            echo "<b>Заказа с таким номером не сущесвует, попробуйте снова</b></br>"; 
            //echo "<a href = '../main.php'><font color = 'red'/><b> Вернуться на главную </b></a>";
            return;
        }

        $db2->query("DELETE FROM archive WHERE id = '$idd'");
        echo "<b>Заказ №$idd Восстановлен</b></br>";
        //echo "<a href = '../main.php'><font color = 'red'/><b> Вернуться на главную </b></a>";
        return;
    }
    echo "<form method = post align = 'right' autocomplete = 'off'>
        <input name = 'id' placeholder = 'номер заказа'/>
        <input type=submit name = 'regenerate' value = 'восстановить'/>
        </form>";
  drow_archive_table();
  function drow_archive_table()
{
    echo "<html>
        <body>
    <table border = '1' bgcolor = 'F0E68C' align = 'center'>
    <thead >
    <th> № </th>
    <th> заказчик </th>
    <th> дата создания </th>
    <th> продавец </th>
    <th> адрес доставки </th>
    <th> товары </th>
    <th> сумма </th>
    <th> оплачено </th>
    <th> менеджер </th>
    <th> доп. инфо </th>
    </thead>
    <tbody>";
        $db = connect_db_orders();
        $result = $db->query("SELECT * FROM archive");
    
        while (($cur_order = $result->fetch_assoc()) == true)
        {  
        echo "<tr> <td>".$cur_order['id']."</td>";
        echo "<td>".$cur_order['заказчик']."</td>";
        echo "<td>".$cur_order['дата']."</td>";
        echo "<td>".$cur_order['продавец']."</td>";
        echo "<td>".$cur_order['адрес_доставки']."</td>";
        echo "<td>".$cur_order['товары']."</td>";
        echo "<td>".$cur_order['сумма']."</td>";
        echo "<td>".$cur_order['оплачено']."</td>";
        echo "<td>".$cur_order['менеджер']."</td>";
        echo "<td>".$cur_order['доп_инфо']."</td></tr>";
        }
        echo "</tbody>
        </table>
    </body>
    </html>";
}

?>
</body>
</html>
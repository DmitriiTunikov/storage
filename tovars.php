<html>
    <body>
<style>
  body { background: url(in1.jpg); }
</style>
<?php
include_once "connect.php";
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
function DrowTovars()
{
        $db = connect_db_orders();
        $result = $db->query("SELECT * FROM $database WHERE состояние = '$state'"); 

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
        echo "<td>".$cur_order['доп_инфо']."</td>";
        echo "<td>".$cur_order['состояние']."</td>
        </tr>";

        }
}
DrowTovars();
?>
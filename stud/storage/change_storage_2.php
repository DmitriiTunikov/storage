<h1 align = 'center'> Склад </h1>
<style>
  body { background: url(in.jpg); }
</style>

<?php
include_once "drow_func.php";
include_once "connect.php";

$db = connect_db_orders();

$result = $db->query("SELECT * FROM sklad_moll");

while (($cur_order = $result->fetch_assoc()) == true)
{
    $id = $cur_order['id'];
    if (isset($_POST["change"."$id"]))
    {
        $name = $cur_order['Название'];
        $color = $cur_order['Цвет'];
        $haveit = $cur_order['Наличие'];
        $dopinf = $cur_order['доп_инфо'];
        $next = $cur_order['Поставка'];
        $categor = $cur_order['Категория'];
        $prize = $cur_order['Цена'];
        

        drow_change_form($id ,$name, $color, $prize, $haveit, $next ,$dopinf, $categor);

        break;
    }
    else if (isset($_POST["delete"."$id"]))
    {
        $db->query("DELETE FROM sklad_moll WHERE id = '$id'");
        echo "Товар удален со склада<br><a href = 'main.php'> Главная </a><br>
        <a href = 'Storage.php'> Склад </a><br>";
    }
}
?>
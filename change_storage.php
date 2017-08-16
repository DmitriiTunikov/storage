<h1 align = 'center'> Склад </h1>
<style>
  body { background: url(in.jpg); }
</style>

<?php
include_once "drow_func.php";
include_once "connect.php";

if (isset($_POST['drow_form_for_new_tovar']))
{
    drow_adding_form();
}

else if (isset($_POST['add_tovar_to_storage']) || isset($_POST['change_tovar_to_storage']))
{
    $db = connect_db_orders();
    
    $id = $_POST['id'];
    $name = $_POST['Название'];
    $color = $_POST['Цвет'];
    $haveit = $_POST['Наличие'];
    $dopinf = $_POST['доп_инфо'];
    
    if (isset($_POST['change_tovar_to_storage']))
    {
            $db->query("UPDATE sklad_moll  SET Название = '$name', Цвет = '$color', Наличие = '$haveit', доп_инфо = '$dopinf' WHERE id = '$id'");

            echo "<font size = '5'>Товар изменен<br><a href = 'main.php'> Главная </a><br>
            <a href = 'Storage.php'> Склад </a><br></font>";
    }
    else
    {
        $db->query("INSERT INTO sklad_moll (Название, Цвет, Наличие, доп_инфо) VALUES ('$name', '$color', '$haveit', '$dopinf')");

        echo "<font size = '5'>Товар добавлен на склад<br><a href = 'main.php'> Главная </a><br>
        <a href = 'Storage.php'> Склад </a></font><br>";
    }
}
?>

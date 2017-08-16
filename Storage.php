<html>
<body>
<h1 align = 'center'> Склад </h1>
  <a href = "main.php"> <b><font size = "5"color = 'black'/> Главная </b></a><br>
<style>
  body { background: url(in.jpg); }
</style>

<?php
include_once "drow_func.php";
include_once "help_func.php";

//рисуем форму для добавления или изменения товара
drow_form_to_update();

drow_storage_table();
?>

<html>
<style>
   .layer0 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 100px; /* Положение от нижнего края */
    left: 715px; /* Положение от правого края */
    height: 30px;
   }
   .layer1 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 310px; /* Положение от правого края */
    height: 30px;
   }
   .layer2 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 460px; /* Положение от правого края */
    height: 30px;
   }
    .layer3 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 610px; /* Положение от правого края */
    height: 30px;
   }
       .layer4 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 760px; /* Положение от правого края */
    height: 30px;
   }
       .layer5 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 910px; /* Положение от правого края */
    height: 30px;
   }
       .layer6 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 1060px; /* Положение от правого края */
    height: 30px;
   }
  </style>
<body>
<h1 align = 'center'> Склад </h1>
  <a href = "../main.php"> <b><font size = "5"color = 'black'/> Главная </b></a><br>
<style>
  body { background: url(../in.jpg); }
</style>

<?php
include_once "../drow_func.php";
include_once "../help_func.php";

function dr_own()
{
       echo "<div class='layer0'>
     <a href = '../Storage.php'> <b><font size = '4'> Все товары </b></a></font>
   </div>";
       echo "<div class='layer1'>
     <a href = 'tables.php'> <b><font size = '4'> Столы </b></a></font>
   </div>";
          echo "<div class='layer2'>
     <a href = 'cheers.php'> <b><font size = '4'> Стулья </b></a></font>
   </div>";
        echo "<div class='layer3'>
     <a href = 'acces.php'> <b><font size = '4'> Аксессуары </b></a></font>
   </div>";
        echo "<div class='layer4'>
     <a href = 'rasshir.php'> <b><font size = '4'> Расширения </b></a></font>
   </div>";
        echo "<div class='layer5'>
     <a href = 'tumbi.php'> <b><font size = '4'> Тумбы </b></a></font>
   </div>";
           echo "<div class='layer6'>
     <a href = 'mebel.php'> <b><font size = '4'> Мягкая мебель </b></a></font>
   </div>";
   
//рисуем форму для добавления или изменения товара
drow_form_to_update(0);
}
?>
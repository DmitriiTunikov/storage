<style>
   .layer1 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 200px; /* Положение от нижнего края */
    left: 400px; /* Положение от правого края */
    height: 30px;
   }
   .layer2 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 200px; /* Положение от нижнего края */
    left: 710px; /* Положение от правого края */
    height: 30px;
   }
    .layer3 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 200px; /* Положение от нижнего края */
    left: 1000px; /* Положение от правого края */
    height: 30px;
   }
  </style>
<?php
function MainPage()
  {
    include_once "connect.php";
    include_once "help_func.php";
    
    $db = connect_db();

    include_once "excel_work.php";
    work_back();
  
       echo "<div class='layer1'>
     <a href = 'unpayd.php'> <b><font size = '4'> Неоплаченные </b></a></font>
   </div>";
       echo "<div class='layer2'>
     <a href = 'payd.php'> <b><font size = '4'> Оплаченные </b></a></font>
   </div>";
        echo "<div class='layer3'>
     <a href = 'delivered.php'> <b><font size = '4'> Доставленные </b></a></font>
   </div>";
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $login = "";
    $login = $_SESSION["login"];
    $page = "";

    $page = $_SESSION["page"];

    if ($page == "ip")
      echo "<h1 align = 'center'> ИП $login </h1>";
    else
      echo "<h1 align = 'center'> ТД Ассамблея </h1>";
  if ($page == "ip")
  {
    echo "
        <a href = 'mainAss.php'> <b><font size = '5'color = 'green'> ТД Ассамблея </b></a><br></font>
</body>
</html>";
  }
  else
  {
    echo "
        <a href = 'mainIp.php'> <b><font size = '5'color = 'green'/> ИП $login </b></a><br></font>
    
</body>
</html>";
}
    echo "<html>
<style>
  body { background: url(in3.jpg); }
</style>
    <body>
        <a href = 'AddNewOrder.php'> <b><font size = '5'color = 'green'> Новый заказ </b></a><br></font>
        <a href = 'Storage.php'> <b><font size = '4'color = 'green'> Склад </b></a><br></font>
        <a href = 'Archive.php'> <b><font size = '3'color = 'green'> Архив </b></a><br></font>
        <a href = 'enter.php'> <b><font size = '5'color = 'black'> Выход </b></a><br></font>
      ";
  }
?>
<?php
function CheckEnter()
{
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if (isset($_SESSION["login"]) &&$_SESSION["login"] != "" && $_SESSION["cur_base"] != "" && isset($_SESSION["cur_base"]))
   {
    $login = $_SESSION["login"];
    $page = $_SESSION["cur_base"];
   }
   else
   {
     echo "<b><font size = '5'>Вы не вошли в систему<br>";
     echo "<a href = '/users/enter/'>Вход</a></font></b>";
     return 1;
   }
   return 0;
}
?>
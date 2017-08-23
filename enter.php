
<html>

<h1> Вход </h1>

<style>
  body { background: url(in.jpg); }
</style>
<form action = "login.php" method=post autocomplete = 'off'>
    <style>
    </style>
    <p><input name="login" placeholder="Логин"/></p>
    <p><input type=password name="password" placeholder="Пароль"/></p>
    <p><input name="manager" placeholder="Менеджер"/></p>
     </br>
    <input type=submit name = "sub-but" value = "вход"/>
</form> 
<a href = "info.html"> Посмотреть номера контактных телефонов </a>

</html>
<?php
   if (!isset($_SESSION))
   {
       session_start();
   }
$_SESSION['second_name'] = "";
?>
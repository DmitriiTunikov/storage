
<h1> Вход </h1>
<?php
echo "
<style>
  body { background: url(".ROOT."/template/images/in.jpg); }
</style>
";?>
<form action = "/users/login/" method=post autocomplete = 'off'>
    <p><input name="login" placeholder="Логин"/></p>
    <p><input type=password name="password" placeholder="Пароль"/></p>
    <p><input name="manager" placeholder="Менеджер"/></p>
     <br>
    <input type=submit name = "sub-but" value = "вход"/>
</form> 
<a href = "users/info"> Посмотреть номера контактных телефонов </a>
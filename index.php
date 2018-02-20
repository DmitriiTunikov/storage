<?php
if (!isset($_SESSION))
{
  session_start();
}

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Db.php');
require_once(ROOT.'/components/Router.php');

$router = new Router();
$new_irl = $router->getURI();
if ($new_irl == 'orders/changeOrder')
    ;
else
{
    echo "<style>
  body { background: url(/template/images/in.jpg); }
    a {
        text-decoration: none;
        display: inline-block;
        padding: 5px 10px;
        letter-spacing: 1px;
        margin: 0 20px;
        font-size: 24px;
        font-family: 'Fredoka One', cursive;
        transition: .3s ease-in-out;
    }

        a:hover {
            color: #154088;
            border-bottom: .07em solid;
        }
</style>
";
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    echo "<a href = '/main'><font size = '5'color = 'black'><b>Главная</b></font></a>";
    // 2. Подключение файлов системы
    //require_once(ROOT.'/Db.php');
    // 3. Установка соединения с БД
}
// 4. Вызор Router

$router->run();
?>
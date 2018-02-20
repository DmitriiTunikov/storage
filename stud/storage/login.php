<?php
//логинизация пользователя после нажатия им кнопки вход на странице ВХОД
    include_once "connect.php";
    include_once "help_func.php";

    $db = connect_db();

    if (!isset($_POST['sub-but']))
    {
        echo "неверный адрес!";
        return;
    }

    if(!empty($_POST['login'])  && !empty($_POST['password']))
    {
      $user_name = trim(strip_tags($_POST['login']));
      $user_password = trim(strip_tags($_POST['password']));   
    }
    else
    {
      echo "вы что-то не ввели, попробуйте вернуться на предыдущую страницу</br><a href = 'enter.php'>Вернуться</a>";
      return;
    }

// здесь будет поиск по базе данных пользователей!
    $flag = 0;
    if (!empty($user_name))
    {
        $cur_id = GetId($user_name);
        $flag = 1;
        if ($cur_id)
        {
            $pass = GetPasswordById($cur_id);
            if ($pass == $user_password)
            {
                    if(!isset($_SESSION)) 
                    { 
                        session_start(); 
                    }
                include_once "mainPage.php";
                include_once "drow_func.php";
                $name = "";

                $_SESSION["manager"] = $_POST['manager'];
                $_SESSION["login"] = $user_name;
                $_SESSION["page"] = "ip";
                $_SESSION['cur_num'] = 1;
                $_SESSION['товар'] = "";
                $_SESSION['цвет'] = "";
                $_SESSION['цена'] = 0;
                $_SESSION['скидка'] = 0;
                $_SESSION['количество'] = 0;
                $_SESSION['is_first'] = 1;

                //setcookie("page","ip",time()+(3600 * 24 * 365));
                if ($user_name == "kruiz_moll")
                  {
                      setcookie("base", "orders",time()+(3600 * 24 * 365));
                      $_SESSION["name"] = "orders";
                  }
                  else if($user_name == "mh_moll")
                  {
                      setcookie("base", "orders_mh",time()+(3600 * 24 * 365));
                      $_SESSION["name"] = "orders_mh";
                  }
                  else if($user_name == "garden_moll")
                  {
                      setcookie("base", "orders_garden",time()+(3600 * 24 * 365));
                      $_SESSION["name"] = "orders_garden";
                  }
                  else if ($user_name == "elena98")
                  {
                      setcookie("base", "orders_mh",time()+(3600 * 24 * 365));
                      $_SESSION["name"] = "orders_mh";
                      $_SESSION["second_name"] = "orders_elena";
                  }
                  header("location: main.php");
                //MainPage();
                //drow_orders_table("не оплачен");
            }
            else
            {
              echo "<b>Неверный логин или пароль, попробуйте снова</b></br><a href = 'enter.php'>Вернуться</a>";
            }
        }
        else
        {
            echo "<b>Неверный логин или пароль, попробуйте снова</b></br><a href = 'enter.php'>Вернуться</a>";
        }
    }
    if ($flag == 0)
      echo "<b>Неверный логин или пароль, попробуйте снова</b></br><a href = 'enter.php'>Вернуться</a>";
?>
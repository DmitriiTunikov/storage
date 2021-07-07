<?php


include_once ROOT. '/models/Users.php';

if (!isset($_SESSION))
{
  session_start();
}

class UsersController
{
    public function actionExit()
	{
        $_SESSION['page'] = "";
        $_SESSION['login'] = "";
        $_SESSION['cur_base'] = "";

        require_once(ROOT . '/views/users/enter.php');
    }
	public function actionLogin()
	{
//логинизация пользователя после нажатия им кнопки вход на странице ВХОД
        $db = Db::connect_db();

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
            echo "вы что-то не ввели, попробуйте вернуться на предыдущую страницу</br><a href = '/users/enter/'>Вернуться</a>";
            return;
        }

    // здесь будет поиск по базе данных пользователей!
        $flag = 0;

        if (!empty($user_name))
        {
            $cur_user = Users::FindUserByLogin($user_name);
            $flag = 1;
            if ($cur_user)
            {
                $pass = $cur_user['password'];
                if ($pass == $user_password)
                {
                    $_SESSION["manager"] = $_POST['manager'];
                    $_SESSION["login"] = $user_name;
                    $_SESSION["order_state"] = "unpayd";
                    if ($user_name == 'moll_kruiz')
                        $_SESSION["cur_base"] = 1;
                    else if ($user_name == 'garden')
                        $_SESSION["cur_base"] = 2;
                    else if ($user_name == 'mebelholl')
                        $_SESSION["cur_base"] = 3;
                    else
                      $_SESSION["cur_base"] = 0;
                    $_SESSION["td"] = 0;
                    $_SESSION["cur_categorigy"] = "all";
                    $_SESSION['back_to_order_reason'] = "add";

                    header('Location: /main/');
	                //require_once(ROOT . '/views/main/main_page.php');
                }
                else
                {
                    echo "<b>Неверный логин или пароль, попробуйте снова</b></br><a href = '/users/enter/'>Вернуться</a>";
                }
            }
            else
            {
                echo "<b>Неверный логин или пароль, попробуйте снова</b></br><a href = '/users/enter/'>Вернуться</a>";
            }
        }
        if ($flag == 0)
        echo "<b>Неверный логин или пароль, попробуйте снова</b></br><a href = '/users/enter/'>Вернуться</a>";
        }

    public function actionEnter()
    {
        require_once(ROOT . '/views/users/enter.php');
    }
}
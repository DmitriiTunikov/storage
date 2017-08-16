<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
  include_once "connect.php";
  
  function check_have_order_num($data_base, $id)
  {
        $db = connect_db_orders();
        $result = $db->query("SELECT * FROM $data_base");

        while (($cur_order = $result->fetch_assoc()) == true)
        {
          if ($cur_order['id'] == $id)
          {
            return 0;
          }
        }
        
        return 1;
  }

  function GetId($login = "")
  { 
    $db = connect_db();

    $result = $db->query("SELECT * FROM users");
  
    while (($user_data = $result->fetch_assoc()) == true)
    {
        if ($user_data['login'] == $login)
          return $user_data['id'];
    }  

    return false;
  }

function drow_form_to_update()
{
  echo "<form method = post action = 'change_storage.php' align = 'right'>
    <input type = submit name = 'drow_form_for_new_tovar' value = 'Добавить новый товар'>
    </form>";
}

  function GetPasswordById($id = "")
  { 
    $db = connect_db();

    $result = $db->query("SELECT * FROM users");
  
    while (($user_data = $result->fetch_assoc()) == true)
    {
        if ($user_data['id'] == $id)
          return $user_data['password'];
    }  

    return false;
  }
  
  function GetMas()
  {
    $mas = array("id" => 0, "заказчик" => "", "дата"=> "", "продавец" => "", "адрес_доставки" => "", "телефон" => "", "товары" => "", "сумма" => 0, "оплачено" => 0,
     "скидка" => 0, "менеджер" => "", "доп.инфо" => "");
    return $mas;
  }

  function UpdateUser($id, $password, $name, $login)
  {
      $db = connect_db();

      $db->query("UPDATE users SET name = '$name', password = '$password', login = '$login' WHERE id = '$id'");
  }
  
  function DeleteUser($id = "")
  {
    $db = connect_db();

    $db->query("DELETE FROM users WHERE id = '$id'");
  }
  
  function AddUser($name = "", $login = "", $password = "")
  {
    $db = connect_db();

    $db->query("INSERT INTO users (name, login, password) VALUES ('$name', '$login', '$password')");
  }
?>
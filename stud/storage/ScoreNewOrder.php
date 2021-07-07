<html>
    <body>
<style>
  body { background: url(in1.jpg); }
</style>
<?php
  $sum;
  $full_order;

  include_once "connect.php";
  include_once "help_func.php";
  if (isset($_POST['add_tovar']))
    {
        include_once "drow_func.php";
        
        RememberData();
        storage_classes("товары");
        drow_tovars_table("Все товары");
    }
    if (isset($_POST['score_order']))
    {
      $db = connect_db_orders();
      
      $datee = date("c");
      $id = $_POST['id'];
      $orderer = $_POST['заказчик'];
      $telephone = $_POST['телефон'];
      $telephone2 = $_POST['телефон2'];
      $manager = $_POST['менеджер'];

      $tovars = array(1=>"", "", "", "", "", "", "", "", "", "");

      $tovar = ""; 
      $tovarCount = "";
      for ($i = 1; $i <= 10; $i++)
      {
          if ($_POST["товар"."$i"] != "")
          {
              $tovars[$i] .= "товар:" . $_POST["товар"."$i"] . ";" . "цвет:" . $_POST['цвет'."$i"] . ";" . "количество:" . $_POST['количество'."$i"] . ";" . "цена:" . 
              $_POST["цена$i"] . ";" ."!"; 
              $tovar .= $_POST["товар"."$i"] . " " . $_POST['цвет'."$i"] . " " . "<b>" . $_POST['количество'."$i"] . "</b>". "<br>";
              //$tovarCount .= $_POST['количество'."$i"] . "<br>";
          }
      }
      $adress = $_POST['адрес'];
      $summm = ScoreSum() * ((100 - $_POST['общая_скидка']) / 100);
      $payd = $_POST['оплачено'];
      $dopinf = $_POST['доп_инфо'];
      $sale = $_POST['общая_скидка'];
      $state = $_POST['состояние'];
      $level = $_POST['этаж'];
      $lift = $_POST['лифт'];

      if (isset($_POST['лифт']))
        $lift = "есть";
      else
        $lift = "нет";  

      if (!isset($_SESSION))
      {
          session_start();
      }
      
      $data_base = "";
      $data_base = $_SESSION["name"];
      
      //проверка что заказа с таким номером еще не существует
      if (!check_have_order_num($data_base, $id))
      {
          RememberData();
          echo "<b>Заказ с таким номером уже существует</b></br>
          <a href = 'back_to_order.php'><b><font size = '5'color = 'green'/> Вернуться к заказу </b></a>
          <a href = 'main.php'><b><font size = '5'color = 'green'/> Вернуться на главную </b></a>";
          return;
      }

      $db->query("INSERT INTO $data_base (id, заказчик, дата, адрес_доставки, телефон, телефон2, менеджер, сумма, товары, количество, скидка, оплачено, доп_инфо, товар1, товар2, товар3,
       товар4, товар5, товар6, товар7, товар8, товар9, товар10, состояние, лифт, этаж) 
      VALUES ('$id', '$orderer', '$datee', '$adress', '$telephone', '$telephone2', '$manager', '$summm', '$tovar', '$tovarCount', '$sale', '$payd', '$dopinf', '$tovars[1]',
       '$tovars[2]', '$tovars[3]', '$tovars[4]', '$tovars[5]', '$tovars[6]', '$tovars[7]', '$tovars[8]', 
       '$tovars[9]', '$tovars[10]', '$state', '$lift', '$level')");

      //очистка временной таблицы для добавления заказа  
      $name = back_base_name();
      $db->query("TRUNCATE TABLE $name");
      
      include_once "Storage_func.php";

      DeleteTovarsFormStorage($tovars);

      if (empty($id))
      {
         $result = $db->query("SELECT * FROM $data_base");
         while (($cur_order = $result->fetch_assoc()) == true)
         {
             $num = $cur_order['id'];
             $id = $num;
         }
      }
      free_session_art();
      $_SESSION['cur_art'] = 0;
      echo "Заказ добавлен под номером № $id </br> <a href = 'main.php'><b><font size = '5'color = 'green'/> Вернуться на главную </b></a>";
  }
  function ScoreSum()
  {
      error_reporting( E_ERROR );
      $full_order = 0;
      $sum = 0;
      $order1 = array('цена1', 'количество1');
      $order2 = array('цена2', 'количество2');
      $order3 = array('цена3', 'количество3');
      $order4 = array('цена4', 'количество4');
      $order5 = array('цена5', 'количество5');
      $order6 = array('цена6', 'количество6');
      $order7 = array('цена7', 'количество7');
      $order8 = array('цена8', 'количество8');
      $order9 = array('цена9', 'количество9');
      $order10 = array('цена10', 'количество10');
      $full_order = array([1] => $order1,[2] => $order2,[3] => $order3,[4] => $order4,[5] => $order5,[6] => $order6,[7] => $order7,[8] => $order8,[9] => $order9
      ,[10] => $order10, [11] => $sum);

      for ($i = 1; $i <= 10; $i++)
      {
          if (isset($_POST["цена"."$i"]) && isset($_POST["количество"."$i"]))
            if ($_POST["цена"."$i"] != 0 && $_POST["количество"."$i"] != 0)
            {
                $full_order[$i]["цена"."$i"] = $_POST["цена"."$i"];
                $full_order[$i]["количество"."$i"] = $_POST["количество"."$i"];
                $full_order[11] += $full_order[$i]["цена"."$i"] * $full_order[$i]["количество"."$i"] * ((100 - $_POST["скидка"."$i"])/100);
                $sum += $full_order[$i]["цена"."$i"] * $full_order[$i]["количество"."$i"] * ((100 - $_POST["скидка"."$i"])/100);
            }
      }
      return $sum;
  }
if (isset($_POST['add_order']))
{
    AddOrder(1);
}
    function AddOrder($flag)
    {
        include_once "drow_func.php";
      $db = connect_db_orders();
      $datee = date("c");

      if ($flag)
      {
      $id = $_POST['id'];
      $orderer = $_POST['заказчик'];
      $telephone = $_POST['телефон'];
      $telephone2 = $_POST['телефон2'];
      $manager = $_POST['менеджер'];

      //массивы для ввода в новую форму после предрассчета
      $prizeMas = array(1=>"","","","","","","","","","");
      $saleMas = array(1=>"","","","","","","","","","");
      $colorMas = array(1=>"","","","","","","","","","");
      $countMas = array(1=>"","","","","","","","","","");
      $tovarMas = array(1=>"","","","","","","","","","");

      $tovar = ""; 
      $tovarCount = "";
      for ($i = 1; $i <= 10; $i++)
      {
          if ($_POST["товар"."$i"] != "")
          {
              $tovarMas[$i] .= $_POST["товар"."$i"];
              $colorMas[$i] .= $_POST["цвет"."$i"];
              $countMas[$i] .= $_POST["количество"."$i"];
              $prizeMas[$i] .= $_POST["цена"."$i"];
              $saleMas[$i] .= $_POST["скидка"."$i"];

              $tovar .= $_POST["товар"."$i"] . " " . $_POST['цвет'."$i"] . " " . "<b>" . $_POST['количество'."$i"] . "</b>". "<br>";
              //$tovarCount .= $_POST['количество'."$i"] . "<br>";
          }
      }
      $adress = $_POST['адрес'];
      $summm = ScoreSum() * ((100 - $_POST['общая_скидка']) / 100);
      $payd = $_POST['оплачено'];
      $dopinf = $_POST['доп_инфо'];
      $sale = $_POST['общая_скидка'];
      $state = $_POST['состояние'];
      $level = $_POST['этаж'];
      $lift = $_POST['лифт'];
      }
    drow_form_full($id, $orderer, $adress, $lift, $level, $telephone, $telephone2, $manager, $tovarMas, $colorMas, $countMas, 
    $prizeMas, $saleMas, $sale, $payd, $dopinf, $state);
    echo "<input type=submit name = 'score_order' value = 'Добавить заказ'/>
</form>";
    }
    function RememberData()
    {
        include_once "help_func.php";

        $mas = back_mas();

        $count = sizeof($mas);

        for($i = 0; $i < $count; $i++)
        {
            if (empty($_POST[$mas[$i]]))
              continue;
            $_SESSION[$mas[$i]] = $_POST[$mas[$i]];
        }
    }
?>
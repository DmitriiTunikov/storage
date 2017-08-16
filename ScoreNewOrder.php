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
        drow_tovars_table(1);
    }
    if (isset($_POST['score_order']))
    {
      $db = connect_db_orders();
      
      $datee = date("c");
      $id = $_POST['id'];
      $orderer = $_POST['заказчик'];
      $telephone = $_POST['телефон'];
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

      $db->query("INSERT INTO $data_base (id, заказчик, дата, адрес_доставки, телефон, менеджер, сумма, товары, количество, скидка, оплачено, доп_инфо, товар1, товар2, товар3,
       товар4, товар5, товар6, товар7, товар8, товар9, товар10, состояние) 
      VALUES ('$id', '$orderer', '$datee', '$adress', '$telephone', '$manager', '$summm', '$tovar', '$tovarCount', '$sale', '$payd', '$dopinf', '$tovars[1]',
       '$tovars[2]', '$tovars[3]', '$tovars[4]', '$tovars[5]', '$tovars[6]', '$tovars[7]', '$tovars[8]', 
       '$tovars[9]', '$tovars[10]', '$state')");

      //очистка временной таблицы для добавления заказа  
      $db->query("TRUNCATE TABLE cur_tovar");
      if (empty($id))
      {
         $result = $db->query("SELECT * FROM $data_base");
         while (($cur_order = $result->fetch_assoc()) == true)
         {
             $num = $cur_order['id'];
             $id = $num;
         }
      }
      
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
      $db = connect_db_orders();
      $datee = date("c");

      if ($flag)
      {
      $id = $_POST['id'];
      $orderer = $_POST['заказчик'];
      $telephone = $_POST['телефон'];
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
      }
      else
      {
          
      }
      echo "<form method='post' autocomplete = 'off'>
    <p><input name='id' placeholder='Номер' value = '$id'/></p>
    <p><input name='заказчик' placeholder='Заказчик' value = '$orderer'/></p>
    <p><input name='адрес' placeholder='Адрес'value = '$adress'/></p>
    <p><input name='телефон' placeholder='Телефон' value = '$telephone'/></p>
    <p><input name='менеджер' placeholder='Менеджер' value = '$manager'/></p>
    <div style = 'float: left;'>";
    for ($i = 1; $i <= 10; $i++)
    {
    echo "<input name = 'товар$i' placeholder= 'товар №$i' value = '$tovarMas[$i]'/>
    <input name = 'цвет$i' placeholder = 'цвет' value = '$colorMas[$i]'/>
    <input name = 'количество$i' placeholder = 'количество' value = '$countMas[$i]'/>
    <input name = 'цена$i' placeholder = 'цена' value = '$prizeMas[$i]'/>
    <input name = 'скидка$i' placeholder = 'скидка'  value = '$saleMas[$i]'/>
    <br>";    
    }
    $sum = 0;
    $full_order = 0;
    $sum = ScoreSum() * ((100 - $_POST['общая_скидка']) / 100);

    echo "<p><input name='общая_скидка' placeholder='Общая скидка' value = '$sale'></p>
    <p><input name='сумма' placeholder='сумма' value = '$sum'> Сумма заказа</p>
    <p><input name='оплачено' placeholder='Оплачено' value = '$payd'/></p>
    <p><input name='доп_инфо' placeholder='Доп.инфо' value = '$dopinf'/></p>
        <p><select name = 'состояние' value = '$state'>
  <option>не оплачен</option>
  <option>оплачен</option>
  <option selected value = '$state'>$state</option>
</select></p>
    <input type=submit name = 'score_order' value = 'Добавить заказ'/>
</form>";
    }
    function RememberData()
    {
        
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['заказчик'] = $_POST['заказчик'];
        $_SESSION['адрес_доставки'] = $_POST['адрес'];
        $_SESSION['телефон'] = $_POST['телефон'];

        for ($i = 1; $i <= 10; $i++)
        {
            if (!empty($_POST['товар'."$i"]))
              $_SESSION['товар'."$i"] = $_POST['товар'."$i"];
        }

        $_SESSION['оплачено'] = $_POST['оплачено'];
        $_SESSION['скидка'] = $_POST['общая_скидка'];
        $_SESSION['менеджер'] = $_POST['менеджер'];
        $_SESSION['доп_инфо'] = $_POST['доп_инфо'];
        $_SESSION['состояние'] = $_POST['состояние'];
    }
?>
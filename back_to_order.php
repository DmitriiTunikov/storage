<style>
  body { background: url(in1.jpg); }
</style>
<?php

  $full_order;
   if (!isset($_SESSION))
      {
          session_start();
      }
include_once "connect.php";
   
   BackToOrder();
   function BackToOrder()
   {
        $db = connect_db();
        $result = $db->query("SELECT * FROM cur_tovar");

        $needToContinue = 0;

        $id = $_SESSION['id']; 

        $orderer = $_SESSION['заказчик'];
        $adress = $_SESSION['адрес_доставки'];
        $telephone = $_SESSION['телефон'];
        $manager = $_SESSION['менеджер'];
        $sale = $_SESSION['скидка'];
        $payd = $_SESSION['оплачено'];
        $dopinf = $_SESSION['доп_инфо'];
        $state = $_SESSION['состояние'];
        
              //массивы для ввода в новую форму после предрассчета
        $prizeMas = array(1=>"","","","","","","","","","");
        $saleMas = array(1=>"","","","","","","","","","");
        $colorMas = array(1=>"","","","","","","","","","");
        $countMas = array(1=>"","","","","","","","","","");
        $tovarMas = array(1=>"","","","","","","","","","");

      $tmp = "";
      $tovar = ""; 
      $tovarCount = "";
      $i = 1;
      while (($cur_order = $result->fetch_assoc()) == true)
        {
            $tovarMas[$i] = $cur_order['Название'];
            $prizeMas[$i] = $cur_order['Цена'];
            $colorMas[$i] = $cur_order['Цвет'];
            $saleMas[$i] = $cur_order['Скидка'];
            $countMas[$i] = 1;
            $i++;
        }
        echo "<form method='post' autocomplete = 'off' action = 'ScoreNewOrder.php'>
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
    echo "<input type = submit name = 'add_tovar' value = 'добавить товар'/>";
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
    <input type=submit name = 'add_order' value = 'Сделать предрассчет'/>
</form>";
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
?>
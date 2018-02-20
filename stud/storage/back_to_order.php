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
include_once "drow_func.php";

   BackToOrder();
   function BackToOrder()
   {
        $db = connect_db();
        $name = back_base_name();

        $result = $db->query("SELECT * FROM $name");

        $needToContinue = 0;

        $id = $_SESSION['id']; 

        $orderer = $_SESSION['заказчик'];
        $adress = $_SESSION['адрес'];
        $telephone = $_SESSION['телефон'];
        $telephone2 = $_SESSION['телефон2'];
        $manager = $_SESSION['менеджер'];
        $sale = $_SESSION['скидка'];
        $payd = $_SESSION['оплачено'];
        $dopinf = $_SESSION['доп_инфо'];
        $state = $_SESSION['состояние'];
        $level = $_SESSION['этаж'];
        $lift = $_SESSION['лифт'];
        
        
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
        drow_form_full($id, $orderer, $adress, $lift, $level, $telephone, $telephone2, $manager, $tovarMas, $colorMas, $countMas, 
        $prizeMas, $saleMas, $sale, $payd, $dopinf, $state);

    echo "<input type=submit name = 'add_order' value = 'Сделать предрассчет'/>
</form>";
        $_SESSION['заказчик'] = "";
         $_SESSION['адрес'] = "";
         $_SESSION['телефон'] = "";
         $_SESSION['телефон2'] = "";
         $_SESSION['менеджер'] = "";
        $_SESSION['скидка'] = "";
        $_SESSION['оплачено'] = "";
        $_SESSION['доп_инфо'] = "";
        $_SESSION['состояние'] = "";
        $_SESSION['этаж'] = "";
        $_SESSION['лифт'] = "";
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
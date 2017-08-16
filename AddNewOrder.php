<?php
   if (!isset($_SESSION))
      {
          session_start();
      }
  include_once "connect.php";
  $sum;
  $full_order;
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

<html>
    <body>
<style>
  body { background: url(in1.jpg); }
</style>
<?php
$manager_name = $_SESSION['manager'];

echo "<form action = 'ScoreNewOrder.php' method= post autocomplete = 'off'>
    <p><input name='id' placeholder='Номер'/></p>
    <p><input name='заказчик' placeholder='Заказчик'/></p>
    <p><input name='адрес' placeholder='Адрес'/></p>
    <p><input name='телефон' placeholder='Телефон'/></p>
    <p><input name='менеджер' placeholder='Менеджер' value = '$manager_name'/></p>
    <div style = 'float: left;'>";
    for ($i = 1; $i <= 10; $i++)
    {
    echo "<input name = 'товар$i' placeholder= 'товар №$i'/>
    <input name = 'цвет$i' placeholder = 'цвет'/>
    <input name = 'количество$i' placeholder = 'количество'/>
    <input name = 'цена$i' placeholder = 'цена'/>
    <input name = 'скидка$i' placeholder = 'скидка'/>
    <br>";    
    }
    echo "<input type = submit name = 'add_tovar' value = 'добавить товар'/>";
    echo "<p><input name='общая_скидка' placeholder='Общая скидка'></p>
    <p><input name='оплачено' placeholder='Оплачено'/></p>
    <p><input name='доп_инфо' placeholder='Доп.инфо'/></p>
        <p><select name = 'состояние'>
  <option>не оплачен</option>
  <option>оплачен</option>
</select></p>
    <input type=submit name = 'add_order' value = 'Сделать предрассчет'/>
</form>";
?>

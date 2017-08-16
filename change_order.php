<html>
    <body>
<style>
  body { background: url(in1.jpg); }
</style>
<?php
  include_once "connect.php";
  include_once "help_func.php";
  include_once "excel_work.php";
   if (!isset($_SESSION))
      {
          session_start();
      }
  if (isset($_POST['add_to_delivered']))
  {
      $num = $_POST['id'];
      add_to_payd_or_delivered("доставлен", $num);
      echo "<b>Заказ №$num добавлен в доставленные</b><br><a href = 'main.php'> <b>Вернуться на главную</b></a>";
  }

  if (isset($_POST['add_to_payd']))
  {
      $num = $_POST['id'];
      add_to_payd_or_delivered("оплачен", $num);
      echo "<b>Заказ №$num добавлен в оплаченные</b><br><a href = 'main.php'> <b>Вернуться на главную</b></a>";
  }

  if (isset($_POST['save']))
  {
      $db = connect_db_orders();
      $result = make_connect($db);
      $needToContinue = 0;
      $idd = $_POST['id']; 

      while (($cur_order = $result->fetch_assoc()) == true)
        {
            if ($cur_order['id'] == $idd)  
            {
                $needToContinue = 1;
                $db1 = connect_db();
                $id = $cur_order['id'];
                $orderer = $cur_order['заказчик'];
                $date = $cur_order['дата'];
                $adress = $cur_order['адрес_доставки'];
                $telephone = $cur_order['телефон'];
                $manager = $cur_order['менеджер'];
                $sum1= $cur_order['сумма'];
                $tovar = $cur_order['товары'];
                $sale = $cur_order['скидка'];
                $payd = $cur_order['оплачено'];
                $dopinf = $cur_order['доп_инфо'];
                $tovars = array(1=>"", "", "", "", "", "", "", "", "", "");

                for ($i = 1; $i <= 10; $i++)
                {
                    $tovars[$i] = $cur_order["товар$i"];
                }

                $number = $_POST['id'];
                
                $dst = 0;
                $src = 0;
                $str = "D:/files/Заказ №$number.xlsx"; 
                MakeNewFizScore($src, $dst, $str);
                break;
            }
        }   
  }
  
  if (isset($_POST['delete']))
    {
        $db = connect_db_orders();
        $result = make_connect($db);
      
        $needToContinue = 0;
        $idd = $_POST['id']; 

        while (($cur_order = $result->fetch_assoc()) == true)
        {
            if ($cur_order['id'] == $idd)  
            {
                $needToContinue = 1;
                $db1 = connect_db();
                $id = $cur_order['id'];
                $orderer = $cur_order['заказчик'];
                $date = $cur_order['дата'];
                $adress = $cur_order['адрес_доставки'];
                $telephone = $cur_order['телефон'];
                $manager = $cur_order['менеджер'];
                $sum1= $cur_order['сумма'];
                $tovar = $cur_order['товары'];
                $sale = $cur_order['скидка'];
                $payd = $cur_order['оплачено'];
                $dopinf = $cur_order['доп_инфо'];
                $tovars = array(1=>"", "", "", "", "", "", "", "", "", "");

                for ($i = 1; $i <= 10; $i++)
                {
                    $tovars[$i] = $cur_order["товар$i"];
                }

                 $db->query("INSERT INTO archive (id, заказчик, дата, адрес_доставки, телефон, менеджер, сумма, товары, скидка, оплачено, доп_инфо, товар1, товар2, товар3,
       товар4, товар5, товар6, товар7, товар8, товар9, товар10) 
      VALUES ('$id', '$orderer', '$date', '$adress', '$telephone', '$manager', '$sum1', '$tovar', '$sale', '$payd', '$dopinf', '$tovars[1]',
       '$tovars[2]', '$tovars[3]', '$tovars[4]', '$tovars[5]', '$tovars[6]', '$tovars[7]', '$tovars[8]', 
       '$tovars[9]', '$tovars[10]')");
       break;
                //$db1->query("INSERT INTO archive (id, заказчик, дата, адрес_доставки, телефон, товары ,менеджер, сумма, скидка, оплачено, доп_инфо) VALUES('$id', '$orderer', '$date', '$adress', 
                //'$telephone','$tovar', '$manager', '$sum1', '$sale', '$payd', '$dopinf')");
            }
        }
        if (!$needToContinue)
        {
            echo "<b>Заказа с таким номером не сущесвует, попробуйте снова</b></br>"; 
            echo "<a href = 'main.php'><font color = 'red'/><b> Вернуться на главную </b></a>";
            return;
        }
               $data_base = "";
      $data_base = $_SESSION["name"];
        $db->query("DELETE FROM $data_base WHERE id = '$idd'");
        echo "<b>Заказ №$idd Удален</b></br>";
        echo "<a href = 'main.php'><font color = 'red'/><b> Вернуться на главную </b></a>";
    }
   else if (isset($_POST['change']))
   {
      DrowForm(0, 0, 0, 0, 0, 0,0, 0,
       0, 0, 0, 0, 0,
          0, 0, 0, 0);
   }
   function DrowForm($flag, $suma,$sale ,$prizeMas1, $saleMas1, $colorMas1,$countMas1, $tovarMas1,
    $id, $orderer, $date, $adress, $telephone,
          $manager, $payd, $dopinf, $state)
   {
        $db = connect_db_orders();
        $result = make_connect($db);
        $needToContinue = 0;
        $idd = $_POST['id']; 
        if (!$flag)
        {
        while (($cur_order = $result->fetch_assoc()) == true)
        {
            if ($cur_order['id'] == $idd)  
            {
                $id = $cur_order['id'];
                $orderer = $cur_order['заказчик'];
                $date = $cur_order['дата'];
                $adress = $cur_order['адрес_доставки'];
                $telephone = $cur_order['телефон'];
                $manager = $cur_order['менеджер'];
                $suma = $cur_order['сумма'];
                $tovar = $cur_order['товары'];
                $sale = $cur_order['скидка'];
                $payd = $cur_order['оплачено'];
                $dopinf = $cur_order['доп_инфо'];
                $state = $cur_order['состояние'];
                break;
            }
        }
              //массивы для ввода в новую форму после предрассчета
      $prizeMas = array(1=>"","","","","","","","","","");
      $saleMas = array(1=>"","","","","","","","","","");
      $colorMas = array(1=>"","","","","","","","","","");
      $countMas = array(1=>"","","","","","","","","","");
      $tovarMas = array(1=>"","","","","","","","","","");

      $tmp = "";
      $tovar = ""; 
      $tovarCount = "";
      for ($i = 1; $i <= 10; $i++)
      {
          if ($cur_order["товар"."$i"] != "")
          {
              $ind = "товар"."$i";
              if (($tmp = strstr("$cur_order[$ind]", "товар:")) != NULL)
              {
                  $j = 0;
                  $tmp = strstr("$tmp", ":");
                  while ($tmp[$j + 1] != ';')
                  {
                      $tovarMas[$i][$j] = $tmp[$j + 1];
                      $j++;
                  }
                  if (($tmp = strstr("$tmp", "цвет:")) != NULL)
                  {
                    $j = 0;
                    $tmp = strstr("$tmp", ":");
                    while ($tmp[$j + 1] != ';')
                    {
                       $colorMas[$i][$j] = $tmp[$j + 1];
                       $j++;
                    }
                  }
                  if (($tmp = strstr("$tmp", "количество:")) != NULL)
                  {
                    $j = 0;
                    $tmp = strstr("$tmp", ":");
                    while ($tmp[$j + 1] != ';')
                    {
                       $countMas[$i][$j] = $tmp[$j + 1];
                       $j++;
                    }
                  }
                  if (($tmp = strstr("$tmp", "цена:")) != NULL)
                  {
                    $j = 0;
                    $tmp = strstr("$tmp", ":");
                    while ($tmp[$j + 1] != ';')
                    {
                       $prizeMas[$i][$j] = $tmp[$j + 1];
                       $j++;
                    }
                  }
              }
          }
      }

    }
     echo "<form method= post autocomplete = 'off' action = 'change_func.php'>
    <p><input name='id' placeholder='Номер' value = '$id'/> Номер заказа </p>
    <p><input name='дата' placeholder='дата' value = '$date'/> Дата </p>
    <p><input name='заказчик' placeholder='Заказчик'value = '$orderer'/> Заказчик</p>
    <p><input name='адрес' placeholder='Адрес' value = '$adress'/> Адрес </p>
    <p><input name='телефон' placeholder='Телефон' value = '$telephone'/> Телефон </p>
    <p><input name='менеджер' placeholder='Менеджер'value = '$manager'/> Менеджер </p>
    <div style = 'float: left;'>";

    if (!$flag)
    {
    for ($i = 1; $i <= 10; $i++)
    {
      echo "<input name = 'товар$i' placeholder= 'товар №$i' value = '$tovarMas[$i]'/>
    <input name = 'цвет$i' placeholder = 'цвет' value = '$colorMas[$i]'/> 
    <input name = 'количество$i' placeholder = 'количество' value = '$countMas[$i]'/> 
    <input name = 'цена$i' placeholder = 'цена' value = '$prizeMas[$i]'/> 
    <input name = 'скидка$i' placeholder = 'скидка'  value = '$saleMas[$i]'/>
    <br>";    
    }
    echo "<p><input name='общая_скидка' placeholder='Общая скидка' value = '$sale'> Общая скидка </p>";
    
    echo "<p><input name='сумма' placeholder='сумма' value = '$suma'> Сумма </p>
    <input type=submit name = 'score_sum' value = 'Посчитать сумму'/>";
    }
    else
    {
    for ($i = 1; $i <= 10; $i++)
    {
      echo "<input name = 'товар$i' placeholder= 'товар №$i' value = '$tovarMas1[$i]'/>
    <input name = 'цвет$i' placeholder = 'цвет' value = '$colorMas1[$i]'/> 
    <input name = 'количество$i' placeholder = 'количество' value = '$countMas1[$i]'/> 
    <input name = 'цена$i' placeholder = 'цена' value = '$prizeMas1[$i]'/> 
    <input name = 'скидка$i' placeholder = 'скидка'  value = '$saleMas1[$i]'/>
    <br>";    
    }
    echo "<p><input name='общая_скидка' placeholder='Общая скидка' value = '$sale'> Общая скидка </p>";
    
    echo "<p><input name='сумма' placeholder='сумма' value = '$suma'> Сумма </p>";
    }

    echo "<p><input name='оплачено' placeholder='Оплачено' value = '$payd'/> Оплачено </p>
    <p><input name='доп_инфо' placeholder='Доп.инфо' value = '$dopinf'/> Доп.инфо </p>
    <p><select name = 'состояние'>
  <option>не оплачен</option>
  <option>оплачен</option>
  <option selected value = '$state'>$state</option>
</select></p>
    <input type=submit name = 'change_order' value = 'Изменить заказ'/>
</form>";
   }
  function make_connect($db)
  {
      if (!isset($_SESSION))
      {
          session_start();
      }
      
      $data_base = "";
      $data_base = $_SESSION["name"];

      $result = $db->query("SELECT * FROM $data_base");
      return $result;
  }

  function add_to_payd_or_delivered($str, $idd)
  {
      $db = connect_db_orders();
      $data_base = "";
      $data_base = $_SESSION["name"];
      $db->query("UPDATE $data_base SET состояние = '$str' WHERE id = '$idd'");
  }

?>

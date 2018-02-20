<?php
  include_once "connect.php";
  include_once "help_func.php";
  include_once "change_order.php";
  if (isset($_POST['change_order']))
      {
        $db = connect_db_orders();
      if (!isset($_SESSION))
      {
          session_start();
      }
      
      $data_base = "";
      $data_base = $_SESSION["name"];

        $result = $db->query("SELECT * FROM $data_base");
        $needToContinue = 0;
                $id = $_POST['id'];
                $orderer = $_POST['заказчик'];
                $date = $_POST['дата'];
                $adress = $_POST['адрес'];
                $telephone = $_POST['телефон'];
                $manager = $_POST['менеджер'];
                $sum1= $_POST['сумма'];
                $sale = $_POST['общая_скидка'];
                $payd = $_POST['оплачено'];
                $dopinf = $_POST['доп_инфо'];
                $state = $_POST['состояние'];
                $tovars = array(1=>"", "", "", "", "", "", "", "", "", "");
                $tovar = "";

                for ($i = 1; $i <= 10; $i++)
                {
                    if ($_POST["товар"."$i"] != "")
                    {
                       $tovars[$i] .= "товар:" . $_POST["товар"."$i"] . ";" . "цвет:" . $_POST['цвет'."$i"] . ";" . "количество:" . $_POST['количество'."$i"] . ";" . "цена:" . 
                       $_POST["цена$i"] . ";" ."!"; 
                       $tovar .= $_POST["товар"."$i"] . " " . $_POST['цвет'."$i"] . " " . "<b>" . $_POST['количество'."$i"] . "</b>". "<br>";
                    }
                }
            $db->query("UPDATE $data_base SET заказчик = '$orderer', дата = '$date', адрес_доставки = '$adress', телефон = '$telephone',
                  менеджер = '$manager', сумма = '$sum1', товары = '$tovar', скидка = '$sale', оплачено = '$payd', доп_инфо = '$dopinf', товар1 = '$tovars[1]',
                   товар2 = '$tovars[2]', товар3  = '$tovars[3]',
       товар4 = '$tovars[4]', товар5 = '$tovars[5]', товар6 = '$tovars[6]', товар7  = '$tovars[7]', товар8 = '$tovars[8]', товар9 = '$tovars[9]',
        товар10 = '$tovars[10]', состояние = '$state' 
       WHERE id = '$id'");
        
        echo "<b>Заказ успешно изменен</b><br>";

        echo "<a href = 'main.php'><font color = 'red'/><b> Вернуться на главную </b></a>";
      }
      else if(isset($_POST['score_sum']))
      {
         BringDataFromForms();
      }
      function BringDataFromForms()
      {
          error_reporting( E_ERROR );
          $sum = 0;
          $sale = $_POST["общая_скидка"];     
          $prizeMas = array(1=>"","","","","","","","","","");
          $saleMas = array(1=>"","","","","","","","","","");
          $colorMas = array(1=>"","","","","","","","","","");
          $countMas = array(1=>"","","","","","","","","","");
          $tovarMas = array(1=>"","","","","","","","","","");

          $id = $_POST['id'];
          $orderer = $_POST['заказчик'];
          $date = $_POST['дата'];
          $adress = $_POST['адрес'];
          $telephone = $_POST['телефон'];
          $manager = $_POST['менеджер'];
          $payd = $_POST['оплачено'];
          $dopinf = $_POST['доп_инфо'];
          $state = $_POST['состояние'];
          for ($i = 1; $i <= 10; $i++)
          {
              if ($_POST["цена"."$i"] != "")
              {
                  $sale1 = $_POST['скидка'.'$i'];
                  $sum += $_POST["цена"."$i"] * $_POST["количество"."$i"] * ((100 - $sale)/100) * ((100 - $sale1)/100);
                  $prizeMas[$i] = $_POST["цена"."$i"];
      $saleMas[$i] = $sale1;
      $colorMas[$i] = $_POST["цвет"."$i"];
      $countMas[$i] = $_POST["количество"."$i"];
      $tovarMas[$i] = $_POST["товар"."$i"];
              }
          }

          DrowForm(1, $sum, $sale, $prizeMas, $saleMas, $colorMas,$countMas, $tovarMas, $id, $orderer, $date, $adress, $telephone,
          $manager, $payd, $dopinf, $state);
      }
?>
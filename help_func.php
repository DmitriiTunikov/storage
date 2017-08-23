<style>
   .layer0 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 100px; /* Положение от нижнего края */
    left: 715px; /* Положение от правого края */
    height: 30px;
   }
   .layer1 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 310px; /* Положение от правого края */
    height: 30px;
   }
   .layer2 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 460px; /* Положение от правого края */
    height: 30px;
   }
    .layer3 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 610px; /* Положение от правого края */
    height: 30px;
   }
       .layer4 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 760px; /* Положение от правого края */
    height: 30px;
   }
       .layer5 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 910px; /* Положение от правого края */
    height: 30px;
   }
       .layer6 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 150px; /* Положение от нижнего края */
    left: 1060px; /* Положение от правого края */
    height: 30px;
   }
  </style>
<?php
error_reporting( E_ERROR );
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
  include_once "connect.php";

  function FindOrder($id)
  {
    $db = connect_db();

    $db_name = $_SESSION["name"];

    $result = $db->query("SELECT * FROM $db_name");
    
    while (($cur_order = $result->fetch_assoc()) == true)
    {
        if ($cur_order['id'] == $id)  
        {
          return $cur_order;
        }
    }
  }

  function BackTovarMas(&$prizeMas, &$saleMas, &$colorMas, &$countMas, &$tovarMas, $cur_order)
  {
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

  function storage_classes($str)
  {
    if ($str == "склад")
    {
          echo "<div class='layer0'>
     <a href = 'Storage.php'> <b><font size = '4'> Все товары </b></a></font>
   </div>";
       echo "<div class='layer1'>
     <a href = '/tovars/tables.php'> <b><font size = '4'> Столы </b></a></font>
   </div>";
          echo "<div class='layer2'>
     <a href = '/tovars/cheers.php'> <b><font size = '4'> Стулья </b></a></font>
   </div>";
        echo "<div class='layer3'>
     <a href = '/tovars/acces.php'> <b><font size = '4'> Аксессуары </b></a></font>
   </div>";
        echo "<div class='layer4'>
     <a href = '/tovars/rasshir.php'> <b><font size = '4'> Расширения </b></a></font>
   </div>";
        echo "<div class='layer5'>
     <a href = '/tovars/tumbi.php'> <b><font size = '4'> Тумбы </b></a></font>
   </div>";
           echo "<div class='layer6'>
     <a href = '/tovars/mebel.php'> <b><font size = '4'> Мягкая мебель </b></a></font>
   </div>";
    }
    else if ($str == "товары")
    {
                echo "<div class='layer0'>
     <a href = 'tovars_table.php'> <b><font size = '4'> Все товары </b></a></font>
   </div>";
       echo "<div class='layer1'>
     <a href = '/tovars2/tables.php'> <b><font size = '4'> Столы </b></a></font>
   </div>";
          echo "<div class='layer2'>
     <a href = '/tovars2/cheers.php'> <b><font size = '4'> Стулья </b></a></font>
   </div>";
        echo "<div class='layer3'>
     <a href = '/tovars2/acces.php'> <b><font size = '4'> Аксессуары </b></a></font>
   </div>";
        echo "<div class='layer4'>
     <a href = '/tovars2/rasshir.php'> <b><font size = '4'> Расширения </b></a></font>
   </div>";
        echo "<div class='layer5'>
     <a href = '/tovars2/tumbi.php'> <b><font size = '4'> Тумбы </b></a></font>
   </div>";
           echo "<div class='layer6'>
     <a href = '/tovars2/mebel.php'> <b><font size = '4'> Мягкая мебель </b></a></font>
   </div>";
    }
  }

  function back_base_name()
  {
    if ($_SESSION["second_name"] == "orders_elena")
      return "cur_tovar_elena";
    if ($_SESSION["name"] == "orders_mh")
      return "cur_tovar_mh";
    if ($_SESSION["name"] == "orders")
      return "cur_tovar";  
    if ($_SESSION["name"] == "orders_garden")
      return "cur_tovar_garden";
    if ($_SESSION["name"] == "orders_td")
      return "cur_tovar_elena";
        
  }

  function back_mas()
  {
        $mas = array('id', 'заказчик', 'адрес', 'телефон', 'телефон2', 'этаж', 'лифт', 'товар1', 'товар2',
         'товар3', '', 'товар4','товар5','товар6','товар7','товар8','товар9','товар10','оплачено','скидка','менеджер','доп_инфо','состояние');
         return $mas;
  }

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

function drow_form_to_update($state)
{
  if ($state)
  {
  echo "<form method = post action = 'change_storage.php' align = 'right'>
    <input type = submit name = 'drow_form_for_new_tovar' value = 'Добавить новый товар'>
    </form>";
  }
  else
  {
    echo "<form method = post action = '../change_storage.php' align = 'right'>
    <input type = submit name = 'drow_form_for_new_tovar' value = 'Добавить новый товар'>
    </form>";
  }
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

  //sum by alphaaas
  function num2str($num) 
  {
    $nul='ноль';
    $ten=array(
      array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
      array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
    );
    $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
    $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
    $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
    $unit=array( // Units
      array('копейка' ,'копейки' ,'копеек',	 1),
      array('рубль'   ,'рубля'   ,'рублей'    ,0),
      array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
      array('миллион' ,'миллиона','миллионов' ,0),
      array('миллиард','милиарда','миллиардов',0),
    );
    //
    list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub)>0) {
      foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
        if (!intval($v)) continue;
        $uk = sizeof($unit)-$uk-1; // unit key
        $gender = $unit[$uk][3];
        list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
        // mega-logic
        $out[] = $hundred[$i1]; # 1xx-9xx
        if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
        else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
        // units without rub & kop
        if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
      } //foreach
    }
    else $out[] = $nul;
    $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
    $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
  }
  
  /**
   * Склоняем словоформу
   * @ author runcore
   */
  function morph($n, $f1, $f2, $f5) {
    $n = abs(intval($n)) % 100;
    if ($n>10 && $n<20) return $f5;
    $n = $n % 10;
    if ($n>1 && $n<5) return $f2;
    if ($n==1) return $f1;
    return $f5;
  }
?>
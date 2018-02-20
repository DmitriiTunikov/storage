<?php
function DeleteTovarsFormStorage($tovars)
{
    include_once "help_func.php";

    $colorMas = array(1=>"","","","","","","","","","");
    $countMas = array(1=>"","","","","","","","","","");
    $tovarMas = array(1=>"","","","","","","","","","");

    FindTovar($colorMas, $countMas, $tovarMas, $tovars);

    DeleteTovars($colorMas, $countMas, $tovarMas);
}

function DeleteTovars($colorMas, $countMas, $tovarMas)
{
    $db = connect_db_orders();
    $result = $db->query("SELECT * FROM sklad_moll");
    
    $used_num = array();
    
    $i = 1;

    while ($i <= 10)
    {
        $state = 0;
        while(($cur_tovar = $result->fetch_assoc()) == true)
        {
            if (strcmp($cur_tovar['Название'], $tovarMas[$i]) == 0)
            {
                if ($cur_tovar['Цвет'] == "" || (strcmp($cur_tovar['Цвет'], $colorMas[$i]) == 0))
                {
                    $count = $cur_tovar['Наличие'] - $countMas[$i];
                    $name = $tovarMas[$i];
                    $color = $colorMas[$i];
                    if (strcmp($cur_tovar['Цвет'], $colorMas[$i]) == 0)
                      $db->query("UPDATE sklad_moll SET Наличие = '$count' WHERE Название = '$name' AND Цвет = '$color'");
                    else
                      $db->query("UPDATE sklad_moll SET Наличие = '$count' WHERE Название = '$name'");
                    $i++;
                    $state = 1;
                    break;
                }
            }
        }
        if (!$state)
          $i++;
    }
}

function free_session_art()
{
  while ($_SESSION['cur_art'] != 0)
  {
      $i = $_SESSION['cur_art'];
      $_SESSION["art_mas"."$i"] = "";
      $_SESSION['cur_art']--;
  }
}

function FindTovar(&$colorMas, &$countMas, &$tovarMas, $tovars)
{
    for ($i = 1; $i <= 10; $i++)
    {
        if ($tovars[$i] != "")
        {
            $ind = "товар"."$i";
            if (($tmp = strstr("$tovars[$i]", "товар:")) != NULL)
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
                /*if (($tmp = strstr("$tmp", "цена:")) != NULL)
                {
                  $j = 0;
                  $tmp = strstr("$tmp", ":");
                  while ($tmp[$j + 1] != ';')
                  {
                     $prizeMas[$i][$j] = $tmp[$j + 1];
                     $j++;
                  }
                }*/
            }
        }
    }
}
?>

<?php
   if (!isset($_SESSION))
      {
          session_start();
      }
require_once 'Classes/PHPExcel.php';
include_once "connect.php";

function AddToDb($name, $color, $haveit, $next, $prize, $categ, $number)
{
  $db = connect_db();
  
  $db->query("INSERT INTO sklad_moll (Название, Цвет, Цена, Категория) VALUES ('$name', '$color' , '$prize', '$categ')");

  if (is_numeric($haveit))
    $db->query("INSERT INTO sklad_moll (Наличие) VALUES ('$haveit') WHERE id = '$number'");
  else
    $db->query("INSERT INTO sklad_moll (Наличие) VALUES ('0') WHERE id = '$number'");

  if (is_numeric($next))
    $db->query("INSERT INTO sklad_moll (Поставка) VALUES ('$next') id = '$number'");
  else
    $db->query("INSERT INTO sklad_moll (Поставка) VALUES ('0') WHERE id = '$number'");
}

function GetDoc($filepath, $sheet)
{
  $ar=array(); // инициализируем массив
  $inputFileType = PHPExcel_IOFactory::identify($filepath);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
  $objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
  $objPHPExcel = $objReader->load($filepath);
  $objPHPExcel->setActiveSheetIndex($sheet); // загружаем данные файла в объект
  $ar = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
  return $ar; //возвращаем массив
}

function MakeNewFizScore(&$src, &$dst, $dst_str)
{
    $_POST['fileSrc'] = $src;
    //header("location: test.php"); 
    if ($_SESSION["second_name"] == "orders_elena")
    {
      work("dar.xls");
      header("location: save_xls.php");
    }
    else if ($_SESSION["name"] == "orders_mh")
    {
      work("dar_mh.xls");
      header("location: save_xls/save_xls_mh.php");
    }
    else if($_SESSION["name"] == "orders_garden")
    {
      work("dar_garden.xls");
      header("location: save_xls/save_xls_garden.php");
    }
    else if($_SESSION["name"] == "orders")
    {
      work("dar_kruiz.xls");
      header("location: save_xls_kruiz.php");
    }
    else if($_SESSION["name"] == "orders_td")
    {
      work("dar_td.xls");
      header("location: save_xls_td.php");
    }
}

function work_back()
{
  include_once 'PHPExcel/IOFactory.php';

  if ($_SESSION["second_name"] == "orders_elena")
  {
    $src_str = "/data/dar.xls";
  }
  else if ($_SESSION["name"] == "orders_mh")
  {
    $src_str = "/data/dar_mh.xls";
  }
  else if($_SESSION["name"] == "orders_garden")
  {
    $src_str = "/data/dar_garden.xls";
  }
  else if($_SESSION["name"] == "orders")
  {
    $src_str = "/data/dar_kruiz.xls";
  }
  else if($_SESSION["name"] == "orders_td")
  {
    $src_str = "/data/dar_td.xls";
  }

    $file_name = $_SERVER['DOCUMENT_ROOT'] . $src_str;
    
    $fileType = 'Excel5';

    $objReader = PHPExcel_IOFactory::createReader($fileType);
    $objPHPExcel = $objReader->load($file_name);

    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B11', "")
            ->setCellValue('B13', "")
            ->setCellValue('B16', "")
            ->setCellValue('B10', "")
            ->setCellValue('I16', "")
            ->setCellValue('J16', "")
            ->setCellValue('E13', "")
            ->setCellValue('J16', "")
            ->setCellValue('J43', "")
            ->setCellValue('I46', "")
            ->setCellValue('I50', "");;

    $num = 20;
    for($i = 1; $i <= 10; $i++)
    {
        $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue("C"."$num", "");
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue("C"."$num","");
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue("H"."$num", "");
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue("I"."$num", "");
      $num++;
    }
    $objPHPExcel->setActiveSheetIndex(1)
    ->setCellValue('A20', "Сумма прописью: ");
  
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
  
  date_default_timezone_set('Europe/Moscow');
  
  ini_set("display_errors",1);
  error_reporting(E_ALL);
  
  $objWriter->save($file_name);
}

function work($str)
{
  include_once 'PHPExcel/IOFactory.php';
  include_once "help_func.php";

    $src_str = "/data//"."$str";

    $file_name = $_SERVER['DOCUMENT_ROOT'] . $src_str;

   $fileType = 'Excel5';

   //$fileType = 'Excel5';
   $objReader = PHPExcel_IOFactory::createReader($fileType);
   $objPHPExcel = $objReader->load($file_name);
  
   $date = date("m.d.y");
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
        $aplha_sum = num2str($_SESSION['сумма']);
  
    $_SESSION['id'] = ""; 
  $_SESSION['заказчик'] = "";
   $_SESSION['адрес']  = "";
  $_SESSION['телефон']  = "";
  $_SESSION['телефон2']  = "";
   $_SESSION['менеджер']  = "";
   $_SESSION['скидка']  = "";
    $_SESSION['оплачено']  = "";
    $_SESSION['доп_инфо']  = "";
    $_SESSION['состояние']  = "";
   $_SESSION['этаж']  = "";
  $_SESSION['лифт'] = "";
  $_SESSION['сумма'] = "";
  
  
  $cur_order = FindOrder($id);

  //init massives
  $prizeMas = array(1=>"","","","","","","","","","");
  $saleMas = array(1=>"","","","","","","","","","");
  $colorMas = array(1=>"","","","","","","","","","");
  $countMas = array(1=>"","","","","","","","","","");
  $tovarMas = array(1=>"","","","","","","","","","");

  //full masssives
  BackTovarMas($prizeMas, $saleMas, $colorMas, $countMas, $tovarMas, $cur_order);
  $num = 20;

  for($i = 1; $i <= 10; $i++)
  {
    if ($tovarMas[$i] != "")
    {
      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("C"."$num", $tovarMas[$i]);
      if($colorMas[$i] != "")
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("C"."$num", $tovarMas[$i] . $colorMas[$i]);
      if ($prizeMas[$i] != "")
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("H"."$num", $prizeMas[$i]);
      if ($countMas[$i] != "")
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("I"."$num", $countMas[$i]);
    }
    $num++;
  }

  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B11', $orderer)
            ->setCellValue('B13', $telephone)
            ->setCellValue('B16', $adress)
            ->setCellValue('B10', $manager)
            ->setCellValue('I16', $level)
            ->setCellValue('J16', $lift)
            ->setCellValue('E13', $telephone2)
            ->setCellValue('J16', $lift)
            ->setCellValue('J43', $payd)
            ->setCellValue('I46', $date)
            ->setCellValue('I50', $date);
   $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A20', "Сумма прописью: " . "$aplha_sum");

             
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
  /* Записываем в файл */
  $objWriter->save($file_name);
}

/*$ar = GetDoc("D:files/tovar.xls", 0);
$i = 2;
$number = 126;
while ($i < 56)
{
  $prize =  $ar[$i][13];
  $cat = $ar[$i][14];

  AddToDb($ar[$i][0], $ar[$i][1],  $ar[$i][5], $ar[$i][11], $prize, $cat, $number);
  $number++;
  $i++;
}*/
/*
$ar = GetDoc("D:files/tovar.xls", 1);
$i = 11;
$number = 1;
while ($i < 137)
{
  $prize =  $ar[$i][16];
  $cat = $ar[$i][17];

  AddToDb($ar[$i][1], $ar[$i][2],  $ar[$i][6], $ar[$i][11], $prize, $cat, $number);
  $number++;
  $i++;
}*/
/*склад молл нулевая страница while ($i < 53)
{
  AddToDb($ar[$i][0], $ar[$i][1],  $ar[$i][5], $ar[$i][10]);

  $i++;
}*/

/*$y = 0;
$i = 4;
$m = $ar[4][7];
$i = 63;
while ($i < 80)
{
  $name = $ar[$i][7];
  $prize = $ar[$i][9];

  AddToDb($name, $prize);
   $i++;
while ($i < 60)
{
  $name = $ar[$i][7];
  $color = $ar[$i][8];
  $prize = $ar[$i][9];

  AddToDb($name, $color, $prize);
  $i++;
  if ($i == 7 || $i == 11 || $i == 14 || $i == 25 || $i == 28 || $i == 22 || $i == 47 || $i == 49 || $i == 52)
  {
    $i += 2;
  }
  else if ($i == 55 || $i == 60)
  {
    $i += 4;
  }
  else if ($i == 18)
  {
    $i += 3;
  }
}
while ($i < 70)
{
  $name = $ar[$i][0];
  $color = $ar[$i][1];
  $prize = $ar[$i][4];

  AddToDb($name, $color, $prize);
  $k++;
  $i++;
  if ($i == 33 || $i == 54)
  {
    $i += 3;
  }
  else if ($k % 4 == 0 && $i <= 33)
  {
    $i += 1;
  } 
  else if ($i == 39 || $i == 58)
  {
    $i += 4;
  }
  
}*/

?>
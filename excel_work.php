
<?php
require_once 'Classes/PHPExcel.php';
/*$srcc = 0;

$dstt = 0;
$str = "D:/files/we.xlsx";
MakeNewFizScore($srcc, $dstt, $str);*/
include_once "connect.php";

/*$inputFileName = "D:files/Score_Moll_fiz.xlsx";

$objPHPExcel = new PHPExcel();

$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

$objPHPExcel->setActiveSheetIndex(0);
$asheet = $objPHPExcel->getActiveSheet(1);

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
  $objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
  $objPHPExcel = $objReader->load($inputFileName);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
$objWriter->save('D:files/Score_fiz10.html');
*/
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

/*function get_value($col, $row)
{
// выбираем лист, с которым будем работать

$pExcel = new PHPExcel();

$pExcel->setActiveSheetIndex(0);
$aSheet = $pExcel->getActiveSheet();
// получаем доступ к ячейке по номеру строки 
// (нумерация с единицы) и столбца (нумерация с нуля) 
$cell = $aSheet->getCellByColumnAndRow($col, $row);
// читаем значение ячейки
$value = $cell->getValue();
return $value;
}

function ToFullDoc()
{
  $value = get_value('A', 47);

  echo "$value";
}*/
function SaveFile($filepath)
{ 
}

function MakeNewFizScore(&$src, &$dst, $dst_str)
{
    $_POST['fileSrc'] = $src;
    header("location: save_xls.php");
}

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
}
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
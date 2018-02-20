<?php
include_once ROOT.'/Classes/PHPExcel.php';
include_once ROOT.'/PHPExcel/IOFactory.php';

// Выводим HTTP-заголовки
header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
header ( "Cache-Control: no-cache, must-revalidate" );
header ( "Pragma: no-cache" );
header ( "Content-type: application/vnd.ms-excel" );
header ( "Content-Disposition: attachment; filename=".$file_name);

$file_name = $_SERVER['DOCUMENT_ROOT'] . "\data\mebelholl.xls";

$objPHPExcel = PHPExcel_IOFactory::load($file_name);

// Выводим содержимое файла
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
$objWriter->save('php://output');
?>
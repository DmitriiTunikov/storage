<?php
    //$src_str = "/data/dar.xls";
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="file.xls"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $src_str = "/data/dar_td.xls";
    $file_name = $_SERVER['DOCUMENT_ROOT'] . $src_str;

    error_reporting(E_ALL);
    set_time_limit(0);

    date_default_timezone_set('Europe/Moscow');
    set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
    include_once 'PHPExcel/IOFactory.php';

    //получаю документ excel 
    //$ar = GetDoc($src_str, 0);
    $fileType = 'Excel5';

    // Read the file
    $objReader = PHPExcel_IOFactory::createReader($fileType);
    $objPHPExcel = $objReader->load($file_name);

    // Write the file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
    $objWriter->save("php://output");
    // $objWriter->save($_SERVER['DOCUMENT_ROOT'] . "/data/tmp.xls");
?>
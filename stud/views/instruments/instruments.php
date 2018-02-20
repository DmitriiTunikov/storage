<html>
<style>
  body { background: url(../template/images/in3.jpg); }
</style>
<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
$cur_instrument_low = mb_strtolower($_SESSION["cur_instrument"]);
$cur_instrument = $_SESSION["cur_instrument"];
$cur_instrument_rus = mb_strtolower($_SESSION["cur_instrument_rus"]);
echo "<a href = '/$cur_instrument_low/add$cur_instrument/'><b><font size = '5'> Добавить $cur_instrument_rus </font></a></br>";
echo "<a href = '/$cur_instrument_low/change$cur_instrument/'><b><font size = '5'> Изменить $cur_instrument_rus </font></a></br>";
?>
</html>
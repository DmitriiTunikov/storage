<a href = "main.php"> <b><font size = "5"color = 'black'/> Главная </b></a><br>
<a href = "Storage.php"> <b><font size = "5"color = 'black'/> Все товары </b></a><br>

<?php
echo "<style>
  body { background: url(in1.jpg); }
</style>";
include_once "drow_func.php";

drow_storage_table(1);
?>
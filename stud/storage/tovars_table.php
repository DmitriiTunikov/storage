
<?php
echo "<style>
  body { background: url(in1.jpg); }
</style>";
include_once "drow_func.php";
include_once "help_func.php";


storage_classes("товары");
drow_tovars_table("Все товары");
?>
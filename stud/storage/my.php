<?php
include_once "connect.php";

    $db = connect_db();
    $db->query("TRUNCATE TABLE tovars");
$db->query("TRUNCATE TABLE sklad_moll");


?>
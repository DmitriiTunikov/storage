<?php
   if (!isset($_SESSION))
      {
          session_start();
      }

      include_once "help_func.php";
var_dump($_SESSION['type']);
var_dump($_SESSION['телефон']);
var_dump($_SESSION['name']);
?>
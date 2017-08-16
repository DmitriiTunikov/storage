<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $_SESSION["name"] = "orders_td";
    $_SESSION["page"] = "td";

  include_once "drow_func.php"; 
  include_once "mainPage.php"; 
  
  MainPage();
  drow_orders_table("не оплачен");
?>
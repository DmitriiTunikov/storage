<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
  $_SESSION["page"] = "ip";
  $_SESSION["name"] = $_COOKIE["base"];

  include_once "drow_func.php"; 
  include_once "mainPage.php"; 
  
  MainPage();
  drow_orders_table("не оплачен");
?>
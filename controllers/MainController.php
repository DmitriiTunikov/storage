<?php

include_once ROOT. '/models/Main.php';
include_once ROOT. '/models/Users.php';
include_once ROOT. '/models/Orders.php';
include_once ROOT. '/checkEnter.php';

if (!isset($_SESSION))
{
  session_start();
}

class MainController
{
    public function actionPay($order_state)
    {
        switch($order_state)
        {
            case 0:
                $_SESSION['order_state'] = "unpayd";
                break;
            case 1:
                $_SESSION['order_state'] = "payd";
                break;
            case 2:
                $_SESSION['order_state'] = "delivered";
                break;
        }
        $this->actionMainPage();
        return true;
    }
    public function actionChangeBase($state)
    {
        if ($state == 0)
            $_SESSION['td'] = 1;
        else
            $_SESSION['td'] = 0;
        $this->actionMainPage();
        return true;
    }
	public function actionMainPage()
	{
    $order_params = Orders::GetOrderParamMas();
    $orderer_params = Orders::GetOrdererParamsMas();
    $db = Db::connect_db();
    if (checkEnter())
    {
      return false;
    }
    $_SESSION['back_to_order_reason'] = "add";
    $cur_state = $_SESSION['order_state'];
    $order_place = $_SESSION['cur_base'];
    if ($order_place != 0)
      $res = $db->query("SELECT * FROM orders WHERE order_place = '$order_place' and state = '$cur_state' and deleted != '1' and td != '1'");
    else
      $res = $db->query("SELECT * FROM orders WHERE state = '$cur_state' and deleted != '1' and td != '1'");
    if ($_SESSION['td'] == 1)
        $res = $db->query("SELECT * FROM orders WHERE state = '$cur_state' and deleted != '1' and td = '1'");
    $db->query("DELETE FROM cur_order WHERE order_place = '$order_place'");
    $db->query("DELETE FROM cur_orderer WHERE order_place = '$order_place'");
    $db->query("DELETE FROM cur_order WHERE order_place = '$order_place'");
    $db->query("DELETE FROM cur_orderer WHERE order_place = '$order_place'");

    $db->query("DELETE FROM cur_products WHERE order_place = '$order_place'");

    $pay_state_rus = Main::GetPayStateRus();
    require_once(ROOT . '/views/main/main_page.php');
    return true;
  }
}

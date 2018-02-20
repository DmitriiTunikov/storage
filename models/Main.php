<?php
if (!isset($_SESSION))
{
  session_start();
}

class Main
{
    public static function GetPayStateRus()
    {
        if ($_SESSION['order_state'] == 'payd')
            return "оплачен";
        else if ($_SESSION['order_state'] == 'unpayd')
            return "не оплачен";
        else if ($_SESSION['order_state'] == 'delivered')
            return "доставлен";
        return "оплачен";
    }
}
?>
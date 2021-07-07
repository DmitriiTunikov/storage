<?php

include_once ROOT. '/models/Orders.php';
include_once ROOT. '/models/Main.php';

/**
 * ArchiveController short summary.
 *
 * ArchiveController description.
 *
 * @version 1.0
 * @author dimat
 */
class ArchiveController
{
    public function actionSearchOrder()
    {
        $db = Db::connect_db();
        $order_params = Orders::GetOrderParamMas();
        $orderer_params = Orders::GetOrdererParamsMas();
        $pay_state_rus = Main::GetPayStateRus();
        if (isset($_POST['search_order']))
        {
            $order_id = $_POST['order_id'];
            $res = $db->query("SELECT * FROM orders WHERE order_id = '$order_id' and deleted = '1'");
            require_once (ROOT.'/views/archive/show_archive.php');
        }
        else if (isset($_POST['reborn_order']))
        {
            $order_id = $_POST['order_id'];
            $db->query("UPDATE orders SET deleted = '0' WHERE order_id = '$order_id'");
            echo "<font size = '5'><br><b>Заказ восстановлен</b></font>";
        }

        return true;
    }

    public function actionShowArchive()
    {
        $db = Db::connect_db();
        $order_place = $_SESSION['cur_base'];
        if ($_SESSION["td"] == 0)
          $res = $db->query("SELECT * FROM orders WHERE deleted = '1'");
        else
            $res = $db->query("SELECT * FROM orders WHERE deleted = '1' and td = '1'");
        $order_params = Orders::GetOrderParamMas();
        $orderer_params = Orders::GetOrdererParamsMas();
        $pay_state_rus = Main::GetPayStateRus();

        require_once (ROOT.'/views/archive/show_archive.php');
        return true;
    }
}
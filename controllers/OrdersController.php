<?php
include_once ROOT. '/models/Users.php';
include_once ROOT. '/models/Orders.php';
include_once ROOT. '/models/Products.php';

if (!isset($_SESSION))
{
  session_start();
}

class OrdersController
{
  public function actionDeleteProduct($product_id)
  {
    $db = Db::connect_db();
    $order_params = Orders::GetOrderParamMas();
    $orderer_params = Orders::GetOrdererParamsMas();
    Orders::RememberData($order_params, $orderer_params);
    $order_place = $_SESSION['cur_base'];
    $db->query("DELETE FROM cur_products WHERE product_id = '$product_id' and order_place = '$order_place'");
    //$_SESSION['back_to_order_reason'] = "change";
    $this->actionBackToOrder();
    return true;
  }

  public function actionBackToOrder()
  {
    $db = Db::connect_db();
    $manager_name = $_SESSION['manager'];
    $order_params_rus = Orders::GetOrderParamMasRus();
    $orderer_params_rus = Orders::GetOrdererParamsMasRus();
    $order_params = Orders::GetOrderParamMas();
    $orderer_params = Orders::GetOrdererParamsMas();
    $product_params = Products::GetProductParamMas();

    $back_to_order_reason = $_SESSION['back_to_order_reason'];
    $order_place = $_SESSION['cur_base'];
    $order = ($db->query("SELECT * FROM cur_order WHERE order_place = '$order_place'"))->fetch();
    $orderer = ($db->query("SELECT * FROM cur_orderer WHERE order_place = '$order_place'"))->fetch();
    $products_res = $db->query("SELECT * FROM cur_products WHERE order_place = '$order_place'");
    $product_params = Products::GetProductParamMas();
    $product_params_rus = Products::GetProductParamMasRus();
    $products_mas = Orders::GetCurProductsMas($products_res);
    $page_state = 0;
    $order_state_rus = Orders::GetPayStateRus($order['state']);
    require_once (ROOT.'/views/orders/add_order_back.php');
    return true;
  }

	public function actionAddProduct($product_id)
	{
    $db = Db::connect_db();
    $product = Products::GetProductById($product_id);
    $ord_place = $_SESSION['cur_base'];
    $row = ($db->query("SELECT count(*) FROM cur_products WHERE product_id = '$product_id' and order_place = '$ord_place'"))->fetch();
    $count = $row[0];
    if (!$count)
      $db->query("INSERT INTO cur_products (product_id, order_place) VALUES ('$product_id', '$ord_place')");
    $order_params = Orders::GetOrderParamMas();
    $orderer_params = Orders::GetOrdererParamsMas();
    $product_params = Products::GetProductParamMas();
    $result = $db->query("SELECT * FROM products");
    require_once (ROOT.'/views/orders/add_product.php');
    return true;
  }

  public function actionScoreOrder()
  {
      $db = Db::connect_db();
      $order_params = Orders::GetOrderParamMas();
      $orderer_params = Orders::GetOrdererParamsMas();
      $product_params = Products::GetProductParamMas();
      $result = $db->query("SELECT * FROM products");
      Orders::RememberData($order_params, $orderer_params);
      $order_place = $_SESSION['cur_base'];

      if (isset($_POST['add_product']))
      {
          require_once (ROOT.'/views/orders/add_product.php');
      }
      else if(isset($_POST['change_order_to_base']))
      {
          Orders::RememberData($order_params, $orderer_params);
          $db->query("DELETE FROM orders WHERE order_id =".$_SESSION['cur_order_id']);
          $db->query("DELETE FROM orderers WHERE orderer_id =".$_SESSION['cur_orderer_id']);
          $db->query("DELETE FROM order_product WHERE order_id =".$_SESSION['cur_order_id']);
          Orders::AddOrderToBase($order_params, $orderer_params, $product_params, $_SESSION['cur_order_id']);
          $db->query("DELETE FROM cur_order WHERE order_place = '$order_place'");
          $db->query("DELETE FROM cur_orderer WHERE order_place = '$order_place'");
          $db->query("DELETE FROM cur_products WHERE order_place = '$order_place'");
          header("location: /main");
      }
      else if(isset($_POST['add_order_to_base']))
      {
          Orders::RememberData($order_params, $orderer_params);
          Orders::AddOrderToBase($order_params, $orderer_params, $product_params, 0);
          $db->query("DELETE FROM cur_order WHERE order_place = '$order_place'");
          $db->query("DELETE FROM cur_orderer WHERE order_place = '$order_place'");
          $db->query("DELETE FROM cur_products WHERE order_place = '$order_place'");
          header("location: /main");
      }
      else if(isset($_POST['score_sum_with_sale']))
      {
          Orders::RememberData($order_params, $orderer_params);
          Orders::SetOrdersCountAndDiscount();
          $products_res = $db->query("SELECT * FROM cur_products WHERE order_place = '$order_place'");
          $prize = Orders::GetProductsPrize($products_res);
          $db->query("UPDATE cur_order SET prize = '$prize' WHERE order_place = '$order_place'");
          //$_SESSION['back_to_order_reason'] = "change";
          $this->actionBackToOrder();
      }
      else
      {
          Orders::RememberData($order_params, $orderer_params);
          $res_cur_products = $db->query("SELECT * FROM cur_products WHERE order_place = '$order_place'");
          $product_mas = Orders::GetCurProductsMas($res_cur_products);
          $size = sizeof($product_mas);
          for ($i = 0; $i < $size; $i++)
          {
              $product_id = $product_mas[$i];
              if (isset($_POST["delete_product"."$product_id"]))
                  $db->query("DELETE FROM cur_products WHERE product_id = '$product_id' and order_place = '$order_place'");
          }
          $this->actionBackToOrder();
      }
      return true;
  }
  public function actionChangeOrder()
  {
      $db = Db::connect_db();
      $order_id = $_POST['order_id'];
      $order = $db->query("SELECT * FROM orders WHERE order_id = '$order_id'")->fetch();
      $orderer_id = $order['orderer_id'];
      $orderer = $db->query("SELECT * FROM orderers WHERE orderer_id = '$orderer_id'")->fetch();
      Orders::CopyOrder($order, $orderer);
      $order_place = $order['order_place'];
      if (isset($_POST['save']))
      {
          $order_product_res = $db->query("SELECT * FROM order_product WHERE order_id = '$order_id'");
          $product_mas = array();
          $product_count = array();
          $i = 0;
          while ($order_product = $order_product_res->fetch())
          {
              $product_mas[$i] = Products::GetProductById($order_product['product_id']);
              $product_count[$i] = $order_product['product_count'];
              $i++;
          }
          $_SESSION['excel'] = 1;
          Orders::CleanXls($order['order_place'], sizeof($product_count));
          Orders::SaveXls($order, $orderer, $product_mas, $product_count);

          $file_name = "�����".$order['order_id'] .".xls";
          if ($order_place == 1)
              require_once(ROOT . '/views/orders/save_order_kruiz.php');
          else if ($order_place == 2)
              require_once(ROOT . '/views/orders/save_order_garden.php');
          else if ($order_place  == 3)
              require_once(ROOT . '/views/orders/save_order_mh.php');
          else 
              require_once(ROOT . '/views/orders/save_order_main.php');
          Orders::CleanXls($order['order_place'], sizeof($product_count));
          $_SESSION['excel'] = 0;
          echo "<a href = '/main'><font size = '5'color = 'black'><b>Главная</b></font></a>";
      }
      else
      {
          echo "<style>
  body { background: url(/template/images/in.jpg); }
    a {
        text-decoration: none;
        display: inline-block;
        padding: 5px 10px;
        letter-spacing: 1px;
        margin: 0 20px;
        font-size: 24px;
        font-family: 'Fredoka One', cursive;
        transition: .3s ease-in-out;
    }

        a:hover {
            color: #154088;
            border-bottom: .07em solid;
        }
</style>
";
          ini_set('display_errors', 1);
          error_reporting(E_ALL);
          echo "<a href = '/main'><font size = '5'color = 'black'><b>Главная</b></font></a>";
          if (isset($_POST['change']))
          {
              $_SESSION['back_to_order_reason'] = "change";
              $_SESSION['cur_order_id'] = $order_id;
              $_SESSION['cur_orderer_id'] = $orderer_id;
              $this->actionBackToOrder();
              return true;
          }
          else if (isset($_POST['delete']))
          {
              $db->query("UPDATE orders SET deleted = '1' WHERE order_id = '$order_id'");
              header("location: /main");
          }
          else if (isset($_POST['add_to_payd']))
          {
              $db->query("UPDATE orders SET state = 'payd' WHERE order_id = '$order_id'");
              header("location: /main");
          }
          else if (isset($_POST['add_to_delivered']))
          {
              $db->query("UPDATE orders SET state = 'delivered' WHERE order_id = '$order_id'");
              header("location: /main");
          }
      }
      $db->query("DELETE FROM cur_order WHERE order_place = '$order_place'");
      $db->query("DELETE FROM cur_orderer WHERE order_place = '$order_place'");
      $db->query("DELETE FROM cur_products WHERE order_place = '$order_place'");//!!!!!!!!!!!!!!
      return true;
  }
  public function actionAddOrder()
	{
      $manager_name = $_SESSION['manager'];
      $order_params_rus = Orders::GetOrderParamMasRus();
      $orderer_params_rus = Orders::GetOrdererParamsMasRus();
      $order_params = Orders::GetOrderParamMas();
      $orderer_params = Orders::GetOrdererParamsMas();
      $db = Db::connect_db();
      require_once(ROOT . '/views/orders/add_order.php');
      return true;
    }
}
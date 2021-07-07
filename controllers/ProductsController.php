<?php
include_once ROOT. '/models/Users.php';
include_once ROOT. '/models/Orders.php';
include_once ROOT. '/models/Products.php';

if (!isset($_SESSION))
{
  session_start();
}

class ProductsController
{
    public function actionSearchProduct()
    {
        $db = Db::connect_db();
        $name = $_POST['name'];
        $product_params = Products::GetProductParamMas();
        $result = $db->query("SELECT * FROM products WHERE product_name LIKE '%$name%'");

        $order_place = $_SESSION['cur_base'];

        require_once (ROOT.'/views/orders/add_product.php');
        return true;
    }

    public function actionShowProducts($categorigy)
    {
        $db = Db::connect_db();
        $product_params = Products::GetProductParamMas();
        if ($categorigy == 0)
          $result = $db->query("SELECT * FROM products");
        else if ($categorigy == 1)
            $result = $db->query("SELECT * FROM products WHERE categorigy LIKE 'Столы'");
        else if ($categorigy == 2)
            $result = $db->query("SELECT * FROM products WHERE categorigy LIKE 'Стулья'");
        else if ($categorigy == 3)
            $result = $db->query("SELECT * FROM products WHERE categorigy LIKE 'Аксессуары'");
        else if ($categorigy == 4)
            $result = $db->query("SELECT * FROM products WHERE categorigy LIKE 'Расширения'");
        else if ($categorigy == 5)
            $result = $db->query("SELECT * FROM products WHERE categorigy LIKE 'Тумбы'");
        else if ($categorigy == 6)
            $result = $db->query("SELECT * FROM products WHERE categorigy LIKE 'Мягкая мебель'");

        $order_place = $_SESSION['cur_base'];

        require_once (ROOT.'/views/orders/add_product.php');
        return true;
    }
}
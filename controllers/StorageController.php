<?php

include_once ROOT. '/models/Storage.php';

/**
 * StorageController short summary.
 *
 * StorageController description.
 *
 * @version 1.0
 * @author dimat
 */
include_once ROOT. '/models/Products.php';

class StorageController
{
    public function actionAddProduct()
    {
        $db = Db::connect_db();
        $product_params = Products::GetProductParamMas();
        $product_params_rus = Products::GetProductParamMasRus();
        require_once (ROOT.'/views/storage/add_product.php');
        return true;
    }

    public function actionChangeProduct($product_id)
    {
        $db = Db::connect_db();
        $product_params = Products::GetProductParamMas();
        $product_params_rus = Products::GetProductParamMasRus();

        $product = $db->query("SELECT * FROM products WHERE product_id = '$product_id'")->fetch();
        require_once (ROOT.'/views/storage/change_product.php');
        return true;
    }

    public function actionChangeProductToBase()
    {
        $product_params = Products::GetProductParamMas();

        Storage::ChangeProductToBase($product_params);
        header("location: /storage/0");
        return true;
    }

    public function actionAddProductToBase()
    {
        $product_params = Products::GetProductParamMas();

        Storage::AddProductToBase($product_params);
        header("location: /storage/0");
        return true;
    }
    public function actionSearchProduct()
    {
        $db = Db::connect_db();
        $product_name = $_POST['product_name'];
        $result = $db->query("SELECT * FROM products WHERE product_name LIKE '%$product_name%'");
        $product_params = Products::GetProductParamMas();

        require_once (ROOT.'/views/storage/show_storage.php');
        return true;
    }

    public function actionShowStorage($categorigy)
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

        require_once (ROOT.'/views/storage/show_storage.php');
        return true;
    }
}
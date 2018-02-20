<?php

class Storage
{
    public static function ChangeProductToBase($product_params)
    {
        $db = Db::connect_db();
        $size = sizeof($product_params);
        $product_id = $_POST['product_id'];
        for ($i = 0; $i < $size; $i++)
        {
            $product_param = $product_params[$i];
            $value = $_POST[$product_param];
            if ($product_param == 'product_id')
                continue;
            $db->query("UPDATE products SET $product_param = '$value' WHERE product_id = '$product_id'");
        }
    }

    public static function AddProductToBase($product_params)
    {
        $db = Db::connect_db();
        $db->query("INSERT INTO products (prize) VALUES ('1')");
        $product_id = $db->lastInsertId();
        $size = sizeof($product_params);
        for ($i = 0; $i < $size; $i++)
        {
            $product_param = $product_params[$i];
            if ($product_param == 'product_id')
                continue;
            $value = $_POST[$product_param];
            
            $db->query("UPDATE products SET $product_param = '$value' WHERE product_id = '$product_id'");
        }
    }
}
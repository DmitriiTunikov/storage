<?php
if (!isset($_SESSION))
{
  session_start();
}

class Products
{
    
    public static function GetProductById($product_id)
    {
        $db = Db::connect_db();
        $res = $db->query("SELECT * FROM products WHERE product_id = '$product_id'");
        return $res->fetch();
    }
    public static function GetProductParamMas()
    {
        $mas = array();
        $mas[0] = 'product_id';
        $mas[1] = 'product_name';
        $mas[2] = 'color';
        $mas[3] = 'prize';
        $mas[4] = 'remainder';
        $mas[5] = 'delivery';
        $mas[6] = 'info';
        $mas[7] = 'categorigy';
        
        return $mas;
    }

    public static function GetProductParamMasRus()
    {
        $mas = array();
        $mas[0] = 'Номер';
        $mas[1] = 'Название';
        $mas[2] = 'Цвет';
        $mas[3] = 'Цена';
        $mas[4] = 'Наличие';
        $mas[5] = 'Поставка';
        $mas[6] = 'Информация';
        $mas[7] = 'Категория';
        
        return $mas;
    }

    public static function GetKindsOfProducts()
    {
        $mas = array();
        $mas[0] = "all";
        $mas[1] = "tables";
        $mas[2] = "cheers";
        $mas[3] = "acces";
        $mas[4] = "expansions";
        $mas[5] = "curbs";
        $mas[6] = "softs";
        return $mas;
    }
    public static function GetKindsOfProductsRus()
    {
        $mas = array();
        $mas[0] = "Все товары";
        $mas[1] = "Столы";
        $mas[2] = "Стулья";
        $mas[3] = "Аксессуары";
        $mas[4] = "Расширения";
        $mas[5] = "Тумбы";
        $mas[6] = "Мягкая мебель";
        return $mas;
    }
}
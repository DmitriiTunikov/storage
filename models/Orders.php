<?php
if (!isset($_SESSION))
{
  session_start();
}

class Orders
{
    public static function GetOrdererParamsMas()
    {
        $orderer_params = array();
        $orderer_params[0] = 'orderer_id';
        $orderer_params[1] = 'orderer_name';
        $orderer_params[4] = 'adress';
        $orderer_params[5] = 'level';
        $orderer_params[6] = 'lift';
        $orderer_params[2] = 'telephone';
        $orderer_params[3] = 'telephone2';
        return $orderer_params;
    }
    public static function SetOrdersCountAndDiscount()
    {
        $order_place = $_SESSION['cur_base'];
        $db = Db::connect_db();
        $products_res = $db->query("SELECT * FROM cur_products WHERE order_place = '$order_place'");
        while ($product = $products_res->fetch())
        {
            $product_id = $product['product_id'];
            $product_discount = $_POST["discount".$product_id];
            $product_count = $_POST["count".$product_id];
            $db->query("UPDATE cur_products SET product_count = '$product_count', product_discount = '$product_discount'
            WHERE product_id = '$product_id'");
        }
        return true;
    }
    public static function GetProductsPrize($products_res)
    {
        $db = Db::connect_db();
        $prize = 0;
        while ($product = $products_res->fetch())
        {
            $product_id = $product['product_id'];
            $cur_product = ($db->query("SELECT * FROM products WHERE product_id = '$product_id'"))->fetch();
            $prize += ($cur_product['prize'] * $product['product_count'] * (1.0 - $product['product_discount'] / 100.0));
        }
        return $prize * (1.0 - $_POST['discount']/100.0);
    }
    //запомнить данные перед добавлением новых товаров в заказ
    public static function RememberData($order_params, $orderer_params)
	{
        $db = Db::connect_db();
        $order_place = $_SESSION['cur_base'];
        error_reporting( E_ERROR );
        $row = ($db->query("SELECT count(*) FROM cur_order WHERE order_place = '$order_place'"))->fetch();
        $count = $row[0];
        if (!$count)
        {
          $db->query("INSERT INTO cur_order (order_place) VALUES ('$order_place')");
          $db->query("INSERT INTO cur_orderer (order_place) VALUES ('$order_place')");
          $db->query("UPDATE cur_order SET order_id = '$order_place' WHERE order_place = '$order_place'");
          $db->query("UPDATE cur_orderer SET orderer_id = '$order_place' WHERE order_place = '$order_place'");
        }

        foreach ($order_params as $order_param)
        {
            if (isset($_POST[$order_param]))
            {
                $value = $_POST[$order_param];
                $db->query("UPDATE cur_order SET $order_param = '$value' WHERE order_place = $order_place");
            }
        }
        foreach ($orderer_params as $orderer_param)
        {
            if (isset($_POST[$orderer_param]))
            {
                $value = $_POST[$orderer_param];

                if ($orderer_param == "lift")
                  $db->query("UPDATE cur_orderer SET $orderer_param = '1' WHERE order_place = $order_place");
                else
                  $db->query("UPDATE cur_orderer SET $orderer_param = '$value' WHERE order_place = $order_place");
            }
        }
    }
    public static function GetOrderParamMas()
	{
        $orders_params = array();
        $orders_params[0] = 'order_id';
        $orders_params[1] = 'orderer_id';
        $orders_params[2] = 'date';
        $orders_params[3] = 'products';
        $orders_params[4] = 'prize';
        $orders_params[5] = 'payd';
        $orders_params[6] = 'discount';
        $orders_params[7] = 'manager';
        $orders_params[8] = 'info';
        $orders_params[9] = 'state';
        return $orders_params;
    }

    public static function CopyOrder($order, $orderer)
    {
        $db = Db::connect_db();
        $order_id = $order['order_id'];
        $products_res = $db->query("SELECT * FROM order_product WHERE order_id = '$order_id'");
        $products_mas = Orders::GetCurProductsMas($products_res);

        $order_place = $order['order_place'];
        $db->query("INSERT INTO cur_order (order_place) VALUES ('$order_place')");
        $db->query("INSERT INTO cur_orderer (order_place) VALUES ('$order_place')");

        foreach ($products_mas as $product_id)
        {
            $count_res = $db->query("SELECT * FROM order_product WHERE order_id = '$order_id' and product_id = '$product_id'")->fetch();
            $count_pr = $count_res['product_count'];
            $row = ($db->query("SELECT count(*) FROM cur_products WHERE product_id = '$product_id' and order_place = '$order_place'"))->fetch();
            $count = $row[0];
            if (!$count)
                $db->query("INSERT INTO cur_products (product_id, order_place, product_count)
                            VALUES ('$product_id', '$order_place', '$count_pr')");
        }

        $order_params = Orders::GetOrderParamMas();
        $orderer_params = Orders::GetOrdererParamsMas();

        foreach ($order_params as $order_param)
        {
            $value = $order[$order_param];
            if ($order_param != 'order_id')
              $db->query("UPDATE cur_order SET $order_param = '$value'");
        }
        foreach ($orderer_params as $orderer_param)
        {
            $value = $orderer[$orderer_param];
            $db->query("UPDATE cur_orderer SET $orderer_param = '$value'");
        }
    }

    public static function AddOrderToBase($order_params, $orderer_params, $product_params, $new_order_id)
    {
        $db = Db::connect_db();
        $db->query("INSERT INTO orderers (telephone) VALUES ('1')");
        $new_orderer_id = $db->lastInsertId();
        $order_place = $_SESSION['cur_base'];
        $db->query("UPDATE cur_order SET orderer_id = '$new_orderer_id' WHERE order_place = '$order_place'");
        $order_place = $_SESSION['cur_base'];
        if ($new_order_id == 0)
        {
            $db->query("INSERT INTO orders (prize) VALUES ('1')");
            $new_order_id = $db->lastInsertId();
        }
        else
            $db->query("INSERT INTO orders (order_id) VALUES ('$new_order_id')");
        $cur_order = $db->query("SELECT * FROM cur_order WHERE order_place = '$order_place'")->fetch();
        $cur_orderer = $db->query("SELECT * FROM cur_orderer WHERE order_place = '$order_place'")->fetch();
        $cur_products_res = $db->query("SELECT * FROM cur_products WHERE order_place = '$order_place'");
        $products_mas = self::GetCurProductsMas($cur_products_res);
        foreach($products_mas as $product_id)
        {
            $count = $_POST["count".$product_id];
            //$count = $cur_product['product_count'];
            $db->query("INSERT INTO order_product (order_id, product_id, product_count) VALUES ('$new_order_id', '$product_id',
            '$count')");
        }
        foreach($order_params as $order_param)
        {
            $value = $cur_order[$order_param];
            if ($order_param == 'state')
            {
                $value = $_POST['state'];
                //$value1 = Orders::GetPayStateRus($value);
                //if ($value1 == "оплачен" || $value1 == "не оплачен" || $value1 == "доставлен")
                //    $value = $value1;
                if ($value == "оплачен")
                    $db->query("UPDATE orders SET $order_param = 'payd' WHERE order_id = $new_order_id");
                else if ($value == "не оплачен")
                    $db->query("UPDATE orders SET $order_param = 'unpayd' WHERE order_id = $new_order_id");
                else if ($value == "доставлен")
                    $db->query("UPDATE orders SET $order_param = 'delivered' WHERE order_id = $new_order_id");
            }
            else if ($order_param == 'order_id')
            {
                $db->query("UPDATE orders SET order_place = '$order_place' WHERE order_id = $new_order_id");
            }
            else
                $db->query("UPDATE orders SET $order_param = '$value' WHERE order_id = $new_order_id");
        }
        foreach($orderer_params as $orderer_param)
        {
            $value = $cur_orderer[$orderer_param];
            if ($orderer_param != 'orderer_id')
              $db->query("UPDATE orderers SET $orderer_param = '$value' WHERE orderer_id = $new_orderer_id");
        }
        if ($_SESSION['td'] == 1)
            $db->query("UPDATE orders SET td = '1' WHERE order_id = $new_order_id");
    }

    public static function BackFileNameByOrderPlace($order_place)
    {
        if ($order_place == 1)
            return "\data\kruiz.xls";
        else if ($order_place == 2)
            return "\data\garden.xls";
        else if ($order_place  == 3)
            return "\data\mebelholl.xls";
        else return "\data\main.xls";
    }

    public static function CleanXls($name, $size)
    {
        include_once ROOT.'/Classes/PHPExcel.php';
        include_once ROOT.'/PHPExcel/IOFactory.php';

        $src_str = Orders::BackFileNameByOrderPlace($name);

        $file_name = $_SERVER['DOCUMENT_ROOT'] . $src_str;

        $fileType = 'Excel5';

        //$fileType = 'Excel5';
        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load($file_name);

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B11', "")
                ->setCellValue('B13', "")
                ->setCellValue('B16', "")
                ->setCellValue('B10', "")
                ->setCellValue('I16', "")
                ->setCellValue('J16', "")
                ->setCellValue('E13', "")
                ->setCellValue('J16', "")
                ->setCellValue('J43', "")
                ->setCellValue('I46', "")
                ->setCellValue('I50', "");;

        $num = 20;
        for ($i = 0; $i < $size; $i++)
        {
            $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue("C"."$num", "");
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("H"."$num", "");
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("I"."$num", "");
            $num++;
        }
        $objPHPExcel->setActiveSheetIndex(1)
        ->setCellValue('A20', "Сумма прописью: ");

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
        /* Записываем в файл */
        $objWriter->save($file_name);
    }

    public static function SaveXls($order, $orderer, $product_mas, $product_count)
    {
        include_once ROOT.'/Classes/PHPExcel.php';
        include_once ROOT.'/PHPExcel/IOFactory.php';

        $src_str = Orders::BackFileNameByOrderPlace($order['order_place']);

        $file_name = $_SERVER['DOCUMENT_ROOT'] . $src_str;

        $fileType = 'Excel5';

        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load($file_name);

        $date = date("m.d.y");

        //full masssives
        $num = 20;

        $size = sizeof($product_count);

        for ($i = 0; $i < $size; $i++)
        {
            $product = $product_mas[$i];
            $count = $product_count[$i];
            $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue("C"."$num", $product['product_name']);
            if($product['color'] != "")
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("C"."$num", $product['product_name'] . $product['color']);
            if ($product['prize'] != "")
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("H"."$num", $product['prize']);
            if ($count != "")
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("I"."$num", $count);
            $num++;
        }

        $aplha_sum = Orders::num2str($order['prize']);
        $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('B11', $orderer['orderer_name'])
                  ->setCellValue('B13', $orderer['telephone'])
                  ->setCellValue('B16', $orderer['adress'])
                  ->setCellValue('B10', $order['manager'])
                  ->setCellValue('I16', $orderer['level'])
                  ->setCellValue('J16', $orderer['lift'])
                  ->setCellValue('E13', $orderer['telephone2'])
                  ->setCellValue('J43', $order['payd'])
                  ->setCellValue('I46', $date)
                  ->setCellValue('I50', $date);
        $objPHPExcel->setActiveSheetIndex(1)
                 ->setCellValue('A20', "Сумма прописью: " . "$aplha_sum");


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
        /* Записываем в файл */
        $objWriter->save($file_name);
    }

    public static function GetCurProductsMas($products_res)
    {
        $i = 0;
        $products_mas = array();
        while ($product_par = $products_res->fetch())
        {
            $products_mas[$i] = $product_par['product_id'];
            $i++;
        }
        return $products_mas;
    }

    public static function GetOrderParamMasRus()
	{
        $orders_params = array();
        $orders_params[0] = 'Номер заказа';
        $orders_params[1] = 'Номер клиента';
        $orders_params[2] = 'Дата';
        $orders_params[3] = 'Продукты';
        $orders_params[4] = 'Сумма';
        $orders_params[5] = 'Оплачено';
        $orders_params[6] = 'Скидка';
        $orders_params[7] = 'Менеджер';
        $orders_params[8] = 'Доп.инфо';
        $orders_params[9] = 'Состояние';
        return $orders_params;
    }

    public static function DeleteOrdererByOrderId($order_id)
    {
        $db = Db::connect_db();
        $orderer_res = $db->query("SELECT orderer_id FROM orders WHERE order_id = '$order_id'")->fetch();
        $orderer_id = $orderer_res['orderer_id'];
        $db->query("DELETE FROM orderers WHERE orderer_id = '$orderer_id'");
    }
    public static function GetOrdererParamsMasRus()
    {
        $orderer_params = array();
        $orderer_params[0] = 'Номер_клиента';
        $orderer_params[1] = 'Заказчик';
        $orderer_params[2] = 'Адрес';
        $orderer_params[3] = 'Этаж';
        $orderer_params[4] = 'Лифт';
        $orderer_params[5] = 'Телефон';
        $orderer_params[6] = 'Телефон';
        return $orderer_params;
    }

    public static function GetPayStateRus($str)
    {
        if ($str == 'payd')
            return "оплачен";
        else if ($str == 'unpayd')
            return "не оплачен";
        else if ($str == 'delivered')
            return "доставлен";
        return $str;
    }

    public static function num2str($num) {
        $nul='ноль';
        $ten=array(
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            array('копейка' ,'копейки' ,'копеек',	 1),
            array('рубль'   ,'рубля'   ,'рублей'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= Orders::morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = Orders::morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.Orders::morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
    }

    /**
     * Склоняем словоформу
     * @ author runcore
     */
    public static function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }
}
?>
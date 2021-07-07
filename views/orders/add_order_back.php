<style>
   .layer10 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 200px; /* Положение от нижнего края */
    /*left: 320; /* Положение от правого края */
   }
 .sent {
    position: absolute; 
    top: 50px; /* Положение от нижнего края */
    left: 600px; /* Положение от правого края */
   }
</style>
<?php
 echo "<form method='post' autocomplete = 'off' action = '/orders/score_order'>";
$arrayObject1 = new ArrayObject($orderer_params);
$arrayObject2 = new ArrayObject($orderer_params_rus);
$iterator1 = $arrayObject1->getIterator();
$iterator2 = $arrayObject2->getIterator();
$tel_flag = 0;
for ($iterator1->rewind(), $iterator2->rewind();
    $orderer_param = $iterator1->current(), $product_param_rus =$iterator2->current();
    $iterator1->next(), $iterator2->next())
{
    $value = $orderer[$orderer_param];
    if ($orderer_param == "lift")
    {
        if ($value == 1)
          echo "<p><input type = radio name='$orderer_param' checked/>$product_param_rus</p>";
        else
          echo "<p><input type = radio name='$orderer_param'/>$product_param_rus</p>";
        continue;
    }
    if ($orderer_param != "orderer_id")
    {
        if ($orderer_param == "telephone")
        {
          echo "<p><input name='$orderer_param' placeholder='$product_param_rus' value = '$value'/>$product_param_rus";
          $iterator1->next();$iterator2->next();
          $orderer_param = $iterator1->current(); $product_param_rus =$iterator2->current();
          $value = $orderer[$orderer_param];
          echo "<input name='$orderer_param' placeholder='$product_param_rus' value = '$value'/>$product_param_rus</p>";continue;
        }
        echo "<p><input name='$orderer_param' placeholder='$product_param_rus' value = '$value'/>$product_param_rus</p>";
    }
}
//products list
echo "<div style = 'float: left;'>";
$tmp_mas = array();
$tmp_mas = $product_params_rus;
$value1 = $product_params_rus[0];
foreach($products_mas as $product_id)
{
    $product = ($db->query("SELECT * FROM products WHERE product_id = '$product_id'"))->fetch();
    $cur_product = $db->query("SELECT * FROM cur_products WHERE product_id = '$product_id' and
    order_place = '$order_place'")->fetch();
    foreach($product_params as $product_param)
    {
        $value = $product[$product_param];
        if ($product_param == "remainder")
        {
            $value = $cur_product['product_count'];
            if ($value == 0)
              echo "<input name='count$product_id' placeholder='количество' value = '1'/>";
            else
              echo "<input name='count$product_id' placeholder='количество' value = '$value'/>";
            continue;
        }
        if ($product_param == "delivery")
        {
            $value = $cur_product['product_discount'];
            echo "<input name='discount$product_id' placeholder='скидка' value = '$value'/>";
            break;
        }
        echo "<input name='$product_param' placeholder='$value1' value = '$value'/>";
        $value1 = next($tmp_mas);
    }
    echo "<input type = submit name = 'delete_product$product_id' value = 'удалить'/>";
    //echo "<a href = '/orders/deleteProduct/$product_id'>Удалить</a>";
    echo "</br>";
}
echo "<input type = submit name = 'add_product' value = 'добавить товар'/>";
//other info
$arrayObject1 = new ArrayObject($order_params);
$arrayObject2 = new ArrayObject($order_params_rus);
$iterator1 = $arrayObject1->getIterator();
$iterator2 = $arrayObject2->getIterator();
$tel_flag = 0;
$size_order = sizeof($order_params);
$size_orderer = sizeof($orderer_params);
if ($back_to_order_reason == "change")
{
    $manager_name = $order['manager'];
}
for ($i = 0; $i < $size_order; $i++)
{
    $order_param = $order_params[$i];
    $order_param_rus = $order_params_rus[$i];
    $value = $order[$order_param];
    if ($order_param == "discount")
    {
        echo "<p><input name='$order_param' placeholder='$order_param_rus' value = '$value'/>$order_param_rus";
        echo "<input type = 'submit' name = 'score_sum_with_sale' value = 'Посчитать сумму с скидками'></p>";
    }
    if ($order_param == "date")
       echo "<p><input type = 'date' name='$order_param' placeholder='$order_param_rus' value = '$value'/>$order_param_rus</p>";
    if ($order_param == "info" || $order_param == "prize" || $order_param == "payd")
    {
        echo "<p><input name='$order_param' placeholder='$order_param_rus' value = '$value'/>$order_param_rus</p>";
    }
    else if ($order_param == "manager")
      echo "<p><input name='$order_param' placeholder='$order_param_rus' value = '$manager_name'/>$order_param_rus</p>";
}
if ($back_to_order_reason == "add")
{
    echo "<p><select name = 'state'>
<option>не оплачен</option>
<option>оплачен</option>
</select></p>";
    echo "<input type=submit name = 'add_order_to_base' value = 'Добавить заказ'>";
}
else
{
    echo "<p><select name = 'state' value = '$order_state_rus'>
  <option>не оплачен</option>
  <option>оплачен</option>
  <option selected value = '$order_state_rus'>$order_state_rus</option>
</select></p>";
    echo "<input type=submit name = 'change_order_to_base' value = 'Изменить заказ'>";
}
?>
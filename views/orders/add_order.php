<style>
   .layer10 {
    position: absolute;
    background: #AFEEEE; /* Цвет фона */
    top: 200px; /* Положение от нижнего края */
    /*left: 100; /* Положение от правого края */
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
    if ($orderer_param == "lift")
    {
        echo "<p><input type = radio name='$orderer_param'/>$product_param_rus</p>";
        continue;
    }
    if ($orderer_param != "orderer_id")
    {
        if ($orderer_param == "telephone")
        {
          echo "<p><input name='$orderer_param' placeholder='$product_param_rus'/>$product_param_rus";
          $iterator1->next();$iterator2->next();
          $orderer_param = $iterator1->current(); $product_param_rus =$iterator2->current();
          echo "<input name='$orderer_param' placeholder='$product_param_rus'/>$product_param_rus</p>";continue;
        }
        echo "<p><input name='$orderer_param' placeholder='$product_param_rus'/>$product_param_rus</p>";
    }
}
echo "<input type = submit name = 'add_product' value = 'добавить товар'/>";
$arrayObject1 = new ArrayObject($order_params);
$arrayObject2 = new ArrayObject($order_params_rus);
$iterator1 = $arrayObject1->getIterator();
$iterator2 = $arrayObject2->getIterator();
$tel_flag = 0;
$date = date("c");
for ($iterator1->rewind(), $iterator2->rewind();
    $order_param = $iterator1->current(), $order_param_rus =$iterator2->current();
    $iterator1->next(), $iterator2->next())
{
    if ($order_param == 'date')
        echo "<p><input type = 'date' name='date' placeholder='дата' value = '$date'/>Дата</p>";
    if ($order_param == "discount" || $order_param == "info")
      echo "<p><input name='$order_param' placeholder='$order_param_rus'/>$order_param_rus</p>";
    else if ($order_param == "manager")
      echo "<p><input name='$order_param' placeholder='$order_param_rus' value = '$manager_name'/>$order_param_rus</p>";
}
?>
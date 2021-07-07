<?php
include_once ROOT. '/checkEnter.php';
if (CheckEnter())
    return;
echo "<br><a href = '/archive'><font size = '5'color = 'black'><b>Все заказы</b></font></a>";
echo"<form action = '/archive/search_order' method = post align = 'right' autocomplete = 'off'>
      <input name = 'order_id' placeholder = 'Номер заказа'/>
      <input type=submit name = 'reborn_order' value = 'Восстановить заказ'/>
      <input type=submit name = 'search_order' value = 'Найти заказ'/>
      </form>";
echo "<table border = '1' bgcolor = '90EE90' align = 'center'>";
    echo "
    <thead >
    <th> № </th>
    <th> заказчик </th>
    <th> телефон </th>
    <th> телефон2 </th>
    <th> адрес доставки </th>
    <th> этаж </th>
    <th> лифт </th>
    <th> дата создания </th>
    <th> товары </th>
    <th> сумма </th>
    <th> оплачено </th>
    <th> скидка </th>
    <th> менеджер </th>
    <th> доп. инфо </th>
    <th> состояние </th>
    </thead>
    <tbody>";
    $orderer_mas_size = sizeof($orderer_params);
    $order_mas_size = sizeof($order_params);

    while (($cur_order = $res->fetch()))
    {
        $order_id = $cur_order['order_id'];
        $orderer_id = $cur_order['orderer_id'];
        $cur_orderer = ($db->query("SELECT * FROM orderers WHERE orderer_id = '$orderer_id'"))->fetch();
        $res_products = $db->query("SELECT order_product.product_count AS product_count, products.product_id AS product_id
        , products.product_name AS product_name FROM (products INNER JOIN order_product
        ON products.product_id = order_product.product_id)
        WHERE order_product.order_id = '$order_id'");
        echo "<tr>";
        for ($i = 0; $i < $order_mas_size; $i++)
        {
            $order_param = $order_params[$i];
            if ($order_param == 'orderer_id')
            {
                for ($j = 0; $j < $orderer_mas_size; $j++)
                {
                    $orderer_param = $orderer_params[$j];
                    if ($orderer_param == 'lift')
                    {
                        if ($cur_orderer[$orderer_param])
                          echo "<td>есть</td>";
                        else
                          echo "<td>нет</td>";
                        continue;
                    }
                    if ($orderer_param != 'orderer_id')
                        echo "<td>".$cur_orderer[$orderer_param]."</td>";
                }
                continue;
            }
            if ($order_param == 'state')
            {
                echo "<td>".$pay_state_rus."</td>";
                continue;
            }
            if ($order_param == 'products')
            {
                echo "<td>";
                while($cur_product = $res_products->fetch())
                {
                    echo $cur_product['product_name'] . " <b>" . $cur_product['product_count'] . "</b></br>";
                }
                echo "</td>";
                continue;
            }
            echo "<td>".$cur_order[$order_param]."</td>";
        }
        echo "</tr>";
      }
?>
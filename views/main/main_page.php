
<style>
    .pay_state {
        position: absolute;
        font-size: 36px;
        line-height: 40px;
        top: 300px;
        left: 750px;
    }
    table {
        background: #f5ffff;
        border-collapse: collapse;
        text-align: left;
    }
      th {
            border-top: 1px solid #777777;
            border-bottom: 1px solid #777777;
            box-shadow: inset 0 1px 0 #999999, inset 0 -1px 0 #999999;
            background: linear-gradient(#9595b6, #5a567f);
            color: white;
            padding: 10px 15px;
            position: relative;
        }

      th:after {
                content: "";
                display: block;
                position: absolute;
                left: 0;
                top: 25%;
                height: 25%;
                width: 100%;
                background: linear-gradient(rgba(255, 255, 255, 0), rgba(255,255,255,.08));
            }

       tr:nth-child(odd) {
            background: #ebf3f9;
        }

      th:first-child {
            border-left: 1px solid #777777;
            border-bottom: 1px solid #777777;
            box-shadow: inset 1px 1px 0 #999999, inset 0 -1px 0 #999999;
        }

     th:last-child {
            border-right: 1px solid #777777;
            border-bottom: 1px solid #777777;
            box-shadow: inset -1px 1px 0 #999999, inset 0 -1px 0 #999999;
        }

        td {
            border: 1px solid #e3eef7;
            padding: 10px 15px;
            position: relative;
            transition: all 0.5s ease;
        }

      tbody:hover td {
            color: transparent;
            text-shadow: 0 0 3px #a09f9d;
        }

      tbody:hover tr:hover td {
            color: #444444;
            text-shadow: none;
        }
    .head_td {
        position: absolute;
        font-size: 36px;
        line-height: 40px;
        top: 100px;
        left: 700px; /* Положение от правого края */
    }
    .head {
        position: absolute;
        font-size: 36px;
        line-height: 40px;
        top: 100px;
        left: 770px; /* Положение от правого края */
    }
    .accepted_payd a {
        position: absolute;
        top: 200px; /* Положение от нижнего края */
        left: 710px; /* Положение от правого края */
        height: 30px;
        border-radius: 10px;
        color: black;
        background: -webkit-linear-gradient(top, #6cea16, #6cea16 50%, #6cea16 50%);
        background: -o-linear-gradient(top, #6cea16, #6cea16 50%, #6cea16 50%);
        background: linear-gradient(to top, #6cea16, #6cea16 50%, #6cea16 50%);
        box-shadow: 2px 2px 3px black;
    }
    .pay_state_payd a {
        position: absolute;
        top: 200px; /* Положение от нижнего края */
        left: 710px; /* Положение от правого края */
        height: 30px;
        border-radius: 10px;
        color: black;
        background: -webkit-linear-gradient(top, #A4D3Ed, #A4D3ED 50%, #CBE3EB 50%);
        background: -o-linear-gradient(top, #A4D3E0, #A4D3E0 50%, #A4D3E0 50%);
        background: linear-gradient(to top, #A4D3E0, #A4D3E0 50%, #A4D3E0 50%);
        box-shadow: 2px 2px 3px black;
    }
    .pay_state_payd a:hover {
        background: -webkit-linear-gradient(bottom, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        background: -o-linear-gradient(bottom, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        background: linear-gradient(to bottom, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
    }
    .accepted_unpayd a {
        position: absolute;
        top: 200px; /* Положение от нижнего края */
        left: 400px; /* Положение от правого края */
        height: 30px;
        border-radius: 10px;
        color: black;
        background: -webkit-linear-gradient(top, #6cea16, #6cea16 50%, #6cea16 50%);
        background: -o-linear-gradient(top, #6cea16, #6cea16 50%, #6cea16 50%);
        background: linear-gradient(to top, #6cea16, #6cea16 50%, #6cea16 50%);
        box-shadow: 2px 2px 3px black;
    }
    .pay_state_unpayd a {
        position: absolute;
        top: 200px; /* Положение от нижнего края */
        left: 400px; /* Положение от правого края */
        height: 30px;
        border-radius: 10px;
        color: black;
        background: -webkit-linear-gradient(top, #A4D3Ed, #A4D3ED 50%, #CBE3EB 50%);
        background: -o-linear-gradient(top, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        background: linear-gradient(to top, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        box-shadow: 2px 2px 3px black;
    }
    .pay_state_unpayd a:hover {
        background: -webkit-linear-gradient(bottom, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        background: -o-linear-gradient(bottom, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        background: linear-gradient(to bottom, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
    }
    .accepted_deliveryed a {
        position: absolute;
        top: 200px; /* Положение от нижнего края */
        left: 1000px; /* Положение от правого края */
        height: 30px;
        border-radius: 10px;
        color: black;
        background: -webkit-linear-gradient(top, #6cea16, #6cea16 50%, #6cea16 50%);
        background: -o-linear-gradient(top, #6cea16, #6cea16 50%, #6cea16 50%);
        background: linear-gradient(to top, #6cea16, #6cea16 50%, #6cea16 50%);
        box-shadow: 2px 2px 3px black;
    }
    .pay_state_deliveryed a {
        position: absolute;
        top: 200px; /* Положение от нижнего края */
        left: 1000px; /* Положение от правого края */
        height: 30px;
        border-radius: 10px;
        color: black;
        background: -webkit-linear-gradient(top, #A4D3Ed, #A4D3ED 50%, #CBE3EB 50%);
        background: -o-linear-gradient(top, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        background: linear-gradient(to top, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        box-shadow: 2px 2px 3px black;
    }

    .pay_state_deliveryed a:hover {
        background: -webkit-linear-gradient(bottom, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        background: -o-linear-gradient(bottom, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
        background: linear-gradient(to bottom, #A4D3E0, #A4D3E0 50%, #CBE3EB 50%);
    }
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
<?php
include_once ROOT. '/checkEnter.php';
if (CheckEnter())
  return;
  $login = $_SESSION["login"];
  $page = $_SESSION["cur_base"];
  if ($cur_state == 'unpayd')
      $style = "accepted_unpayd";
  else $style = "pay_state_unpayd";
  echo "<div class= $style>
     <a href = '/main/pay/0'> <b><font size = '4'> Не оплаченные </b></a></font>
   </div>";
  if ($cur_state == 'payd')
      $style = "accepted_payd";
  else $style = "pay_state_payd";
       echo "<div class=$style>
     <a href = '/main/pay/1'> <b><font size = '4'> Оплаченные </b></a></font>
   </div>";
if ($cur_state == 'delivered')
    $style = "accepted_deliveryed";
else $style = "pay_state_deliveryed";
       echo "<div class=$style>
     <a href = '/main/pay/2'> <b><font size = '4'> Доставленные </b></a></font>
   </div>";
       if ($_SESSION['td'] != 1)
       {
           echo "<a href = '/main/change_base/0'> <b><font size = '5'color = 'black'> ТД Ассамблея </b></a><br></font>
<div class = 'head'> ИП</div>";
       }
       else{
           echo "<a href = '/main/change_base/1'> <b><font size = '5'color = 'black'> ИП </b></a><br></font>
<div class = 'head_td'> ТД Ассамблея </div>";
       }
    echo "<style>
  body { background: url(/template/images/in3.jpg);background-size: cover; }
</style>
    <body>
        <a href = '/orders/add/'><font size = '5' color = 'black'><b>Новый заказ </b></a><br>
        <a href = '/storage/0'> <b><font size = '5'color = 'black'> <b>Склад </b></a><br></font>
        <a href = '/archive'> <b><font size = '5'color = 'black'> <b>Архив </b></a><br></font>
        <a href = '/users/exit'> <b><font size = '5'color = 'black'> <b>Выход </b></a><br></font>
      ";
      $state = $_SESSION['order_state'];
  echo"<form action = '/orders/changeOrder' method = post align = 'right' autocomplete = 'off'>
      <input name = 'order_id' placeholder = 'номер заказа'/>
      <input type=submit name = 'delete' value = 'удалить'/>
      <input type=submit name = 'change' value = 'изменить'/>
      <input type=submit name = 'save' value = 'сохранить'/></br></br>
      <input type=submit name = 'add_to_payd' value = 'добавить в оплаченные'/>
      <input type=submit name = 'add_to_delivered' value = 'добавить в доставленные'/>
      </form>";
    if ($state == "unpayd")
    {
        echo "<style>    table {
        background: #f5ffff;
        border-collapse: collapse;
        text-align: left;
    }</style><table border = '1' bgcolor = 'F0E68C' align = 'center'>";
    }
    else if ($state == "payd")
    {
       echo "<table border = '1' bgcolor = 'F0E68C' align = 'center'>";
    }
    else if ($state == "delivered")
    {
       echo "<table border = '1' bgcolor = '90EE90' align = 'center'>";
    }
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
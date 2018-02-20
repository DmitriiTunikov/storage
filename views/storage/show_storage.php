<?php
include_once ROOT.'/styles.php';
echo "<div class='layer0'>
                <a href = '/storage/0'> <b><font size = '4'> Все товары </b></a></font>
              </div>";
echo "<div class='layer1'>
                <a href = '/storage/1'> <b><font size = '4'> Столы </b></a></font>
              </div>";
echo "<div class='layer2'>
                <a href = '/storage/2'> <b><font size = '4'> Стулья </b></a></font>
              </div>";
echo "<div class='layer3'>
                <a href = '/storage/3'> <b><font size = '4'> Аксессуары </b></a></font>
              </div>";
echo "<div class='layer4'>
                <a href = '/storage/4'> <b><font size = '4'> Расширения </b></a></font>
              </div>";
echo "<div class='layer5'>
                <a href = '/storage/5'> <b><font size = '4'> Тумбы </b></a></font>
              </div>";
echo "<div class='layer6'>
                <a href = '/storage/6'> <b><font size = '4'> Мягкая мебель </b></a></font>
              </div>";
if ($_SESSION['cur_base'] == 0)
        echo "<br><a href = '/storage/add_product'><font size = '5'color = 'black'><b> Добавить новый продукт </b></a><br>";

echo "<form method = post action = '/storage/search_product' align = 'right' autocomplete = 'on'>
                <input name = 'product_name' placeholder = 'наименование'>
                <input type = submit name = 'search_product' value = 'поиск товара'></form>";
echo "<html>
                  <body>
                  <div class = 'layer10'>
                  <table border = '1' bgcolor = 'AFEEEE' align = 'center'>
                  <thead >
                  <th> № </th>
                  <th> Наименование </th>
                  <th> Цвет </th>
                  <th> Цена </th>
                  <th> Наличие </th>
                  <th> Поставка </th>
                  <th> Доп.Инфо </th>
                  <th> Категория </th>";

                 if ($_SESSION["cur_base"] == 0)
                   echo "<th> Изменить </th>";
                  echo "</thead>
                  <tbody>";

while ($cur_product = $result->fetch())
{
    if ($_SESSION['cur_categorigy'] == "all" || $_SESSION['cur_categorigy'] == $cur_product['categorigy'])
    {
        $product_id = $cur_product['product_id'];
        echo "<tr>";
        foreach($product_params as $product_param)
        {
            if ($product_param == "remainder" || $product_param == "delivery")
            {
                if ($_SESSION["cur_base"] == 0 || $cur_product[$product_param] < 4)
                {
                    echo "<td>".$cur_product[$product_param]."</td>";
                }
                else
                    echo "<td> Есть </td>";
            }
            else
                echo "<td>".$cur_product[$product_param]."</td>";
        }
        if ($_SESSION["cur_base"] == 0)
          echo "<td><a href = '/storage/change_product/$product_id'>Изменить</td>";
        echo "</tr>";
    }
}
echo "</tbody>
                      </table>
                      </div>
                  </body>
                  </html>";
?>
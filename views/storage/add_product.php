<?php
$size = sizeof($product_params);
echo "<form method='post' autocomplete = 'off' action = '/storage/add_product_to_base'>";
for ($i = 0; $i < $size; $i++)
{
    $product_param = $product_params[$i];
    if ($product_param == 'product_id')
        continue;
    $product_param_rus = $product_params_rus[$i];
    if ($product_param != "categorigy")
      echo "<p><input name='$product_param' placeholder='$product_param_rus'/>$product_param_rus";
    else
        echo "<p><select name = 'categorigy'>
<option>Столы</option>
<option>Стулья</option>
<option>Аксессуары</option>
<option>Тумбы</option>
<option>Расширения</option>
<option>Мягкая мебель</option>
</select></p>";

}
echo "<br><input type=submit name = 'add_product' value = 'Добавить продукт'>";
?>
<?php
$size = sizeof($product_params);
echo "<form method='post' autocomplete = 'off' action = '/storage/change_product_to_base'>";
for ($i = 0; $i < $size; $i++)
{
    $product_param = $product_params[$i];
    $value = $product[$product_param];
    $product_param_rus = $product_params_rus[$i];
    if ($product_param == 'product_id')
    {
        echo "<p><input name='$product_param' placeholder='$product_param_rus' value = '$value'/>$product_param_rus";
        continue;
    }
    if ($product_param != "categorigy")
        echo "<p><input name='$product_param' placeholder='$product_param_rus' value = '$value'/>$product_param_rus";
    else
        echo "<p><select name = 'categorigy' value = '$value'>
<option>Столы</option>
<option>Стулья</option>
<option>Аксессуары</option>
<option>Расширения</option>
<option>Тумбы</option>
<option>Мягкая мебель</option>
<option selected value = '$value'>$value</option>
</select></p>";
}
echo "<br><input type=submit name = 'change_product' value = 'Изменить продукт'>";
?>
<font size = '5' color = 'red'><b> Поиск записей </b></font>
<table border = '1' bgcolor = 'AFEEEE'>
    <thead >
    <th> Тип поиска </th>
    <th> Размер таблицы(строк) </th>
    <th> Время поиска </th>
    </thead>
    <tbody>
    <?php 
    echo "<tr><td> По ключевому полю </td>";
            echo "<td> 1000 </td>";
            echo "<td>".$time_key_1."</td></tr>";
    echo "<tr><td> По ключевому полю </td>";
            echo "<td> 10000 </td>";
            echo "<td>".$time_key_10."</td></tr>";
    echo "<tr><td> По ключевому полю </td>";
            echo "<td> 100000 </td>";
            echo "<td>".$time_key_100."</td></tr>";
    
    echo "<tr><td> По не ключевому полю </td>";
            echo "<td> 1000 </td>";
            echo "<td>".$time_nkey_1."</td></tr>";
    echo "<tr><td> По не ключевому полю </td>";
            echo "<td> 10000 </td>";
            echo "<td>".$time_nkey_10."</td></tr>";
    echo "<tr><td> По не ключевому полю </td>";
            echo "<td> 100000 </td>";
            echo "<td>".$time_nkey_100."</td></tr>";
    
    echo "<tr><td> По маске </td>";
            echo "<td> 1000 </td>";
            echo "<td>".$time_mask_1."</td></tr>";
    echo "<tr><td> По маске </td>";
            echo "<td> 10000 </td>";
            echo "<td>".$time_mask_10."</td></tr>";
    echo "<tr><td> По маске </td>";
            echo "<td> 100000 </td>";
            echo "<td>".$time_mask_100."</td></tr>";
    
    ?>
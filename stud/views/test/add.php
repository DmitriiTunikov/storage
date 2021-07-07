<font size = '5' color = 'red'><b> Вставка и удаление записи </b></font>
<table border = '1' bgcolor = 'AFEEEE'>
    <thead >
    <th> Тип запроса </th>
    <th> Размер таблицы(строк) </th>
    <th> Время запроса </th>
    </thead>
    <tbody>
    <?php 
    echo "<tr><td> Вставка </td>";
            echo "<td> 1000 </td>";
            echo "<td>".$time_insert_1."</td></tr>";    
    echo "<tr><td> Вставка </td>";
            echo "<td> 10000 </td>";
            echo "<td>".$time_insert_10."</td></tr>";
    echo "<tr><td> Вставка </td>";
            echo "<td> 100000 </td>";
            echo "<td>".$time_insert_100."</td></tr>";
    
    echo "<tr><td> Удаление по ключевому </td>";
            echo "<td> 1000 </td>";
            echo "<td>".$time_delete_key_1."</td></tr>";
    echo "<tr><td> Удаление по ключевому </td>";
            echo "<td> 10000 </td>";
            echo "<td>".$time_delete_key_10."</td></tr>";
    echo "<tr><td> Удаление по ключевому </td>";
            echo "<td> 100000 </td>";
            echo "<td>".$time_delete_key_100."</td></tr>";
    
    echo "<tr><td> Удаление по не ключевому </td>";
            echo "<td> 1000 </td>";
            echo "<td>".$time_delete_nkey_1."</td></tr>";
    echo "<tr><td> Удаление по не ключевому </td>";
            echo "<td> 10000 </td>";
            echo "<td>".$time_delete_nkey_10."</td></tr>";
    echo "<tr><td> Удаление по не ключевому </td>";
            echo "<td> 100000 </td>";
            echo "<td>".$time_delete_nkey_100."</td></tr>";
    
    ?>
<font size = '5' color = 'red'><b> Изменение записи </b></font>
<table border = '1' bgcolor = 'AFEEEE'>
    <thead >
    <th> Тип запроса </th>
    <th> Размер таблицы(строк) </th>
    <th> Время запроса </th>
    </thead>
    <tbody>
    <?php 
    echo "<tr><td> Изменение по ключевому полю </td>";
            echo "<td> 1000 </td>";
            echo "<td>".$time_edit_key_1."</td></tr>";    
    echo "<tr><td> Изменение по ключевому полю </td>";
            echo "<td> 10000 </td>";
            echo "<td>".$time_edit_key_10."</td></tr>";
    echo "<tr><td> Изменение по ключевому полю </td>";
            echo "<td> 100000 </td>";
            echo "<td>".$time_edit_key_100."</td></tr>";
    echo "<tr><td> Изменение по не ключевому полю </td>";
            echo "<td> 1000 </td>";
            echo "<td>".$time_edit_nkey_1."</td></tr>";
    ?>
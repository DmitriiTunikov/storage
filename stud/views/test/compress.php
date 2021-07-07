<font size = '5' color = 'red'><b> Сжатие БД - удаление двухсот строк </b></font>
<table border = '1' bgcolor = 'AFEEEE'>
    <thead >
    <th> Размер таблицы(строк) </th>
    <th> Время сжатия </th>
    </thead>
    <tbody>
    <?php  
    
    echo "<tr><td> 1000 </td>";
    echo "<td>".$time_comp_1."</td></tr>";

            echo "<tr><td> 10000 </td>";
            echo "<td>".$time_comp_10."</td></tr>";

            echo "<tr><td> 100000 </td>";
            echo "<td>".$time_comp_100."</td></tr>";
    ?>
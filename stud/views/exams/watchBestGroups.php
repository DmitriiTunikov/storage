<font size = '5' color = 'red'><b> Лучшие группы <b></font></br>
<table border = 1>
<thead>
    <th> Место </th>
    <th> Номер группы </th>
    <th> Средний балл </th>
    </thead>
<tbody>
<?php

foreach ($groups as $groupItem):
  {
      $mark = number_format($groupItem['mark'], 2);
      echo "<tr><td>".$groupItem['place']."</td>";
      echo "<td>".$groupItem['group_id']."</td>";
      echo "<td>".$mark."</td></tr>";
  }
endforeach;
?>
</table>
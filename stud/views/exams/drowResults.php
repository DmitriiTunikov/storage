<font size = '5' color = 'red'><b> Результаты экзамена <?php echo $exam_name;?> группы №<?php echo $group_name;?><b></font></br>
<table border = 1>
<thead>
    <th> Студент </th>
    <th> Оценка </th>
    </thead>
<tbody>
<?php

foreach ($studentsList as $studentItem):
    {
        echo "<tr><td>".$studentItem['student_name']."</td>";
        echo "<td>".$studentItem['exam_mark']."</td></tr>";
    }
endforeach;
?>
</tbody></table>
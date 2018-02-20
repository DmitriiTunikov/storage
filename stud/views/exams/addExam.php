<font size = '5' color = 'red'><b> Выберите дату и предмет экзамена <b></font></br>
<?php
$group_id = $group['group_id'];
echo "<form method = 'post' action = '/exams/addExamToBase/'>
<input name = 'group_id' value = '$group_id' readonly/> ID group</br>
<input type = 'date' name = 'exam_date'/> Дата экзамена </br>";
$i = 0;
foreach ($subjectList as $subjectItem):
    {
       $subject_id = $subjectItem['subject_id'];
       $subject_name = $subjectItem['subject_name'];
       echo "<input name = 'subject' value = '$subject_id' type = 'radio'> $subject_name </br>"; 
    }
endforeach;
echo "<input type = submit name = 'add_exam' value = 'Добавить экзамен'/></br>";
echo "</form>";
?>
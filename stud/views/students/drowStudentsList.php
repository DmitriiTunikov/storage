<font size = '5' color = 'red'><b> Выберите студента <b></font></br>
<?php
foreach ($studentsList as $studentsItem):
    {
       $student_id = $studentsItem['student_id'];
       $student_name = $studentsItem['student_name'];
       echo "<a href = '/exams/resultExamToStudent/$group_id/$student_id'> $student_name </br>";
    }
endforeach;
echo "</form>";
?>
<font size = '5' color = 'red'><b> Внесите результат экзамена <b></font></br>
<?php
if (!isset($_SESSION))
{
  session_start();
}
$student_name = $student['student_surname'] . ' ' . $student['student_name'] . ' '. $student['student_patronymic']; 
echo "<font size = '3' color = 'green'><b> Студент: $student_name</br> Экзамен: $exam_name </br> Дата экзамена: $exam_date</br></font></b>";

echo "<form method = 'post' action = '/exams/resultExamToBase/'>";
$i = 0;
echo "<p><select name='mark'>
<option value='посредственно'>Посредственно</option>
<option value='удовлетворительно'>Удовлетворительно</option>
<option value='хорошо'>Хорошо</option>
<option value='очень хорошо'>Очень хорошо</option>
<option value='отлично'>Отлично</option>
</select></p>";
echo "<input type = submit name = 'result_exam' value = 'Поставить оценку'/></br>";
echo "</form>";
?>
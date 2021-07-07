<font size = '5' color = 'red'><b> Выберите экзамен <b></font></br>
<?php
$i = 0;
if (!isset($_SESSION))
{
  session_start();
}
foreach ($examsList as $examItem):
    {
       $exam_id = $examItem['exam_id'];
       $exam_name = $examItem['exam_name'] . ' ' . $examItem['exam_date'];
       if ($_SESSION['exams_list_reason'] == 'check_exam') 
       {
         $_SESSION['cur_student'] = $student;
         $_SESSION['cur_exam_name'] = $exam_name;
         if ($examItem['question_id'] != -1)
           echo "<a href = '/exams/checkExam/$exam_id'> $exam_name </br></a>";
       }
       else if ($_SESSION['exams_list_reason'] == 'watch_results')
         echo "<a href = '/exams/watchResultsExam/$exam_id/$group_id'> $exam_name </br></a>";
       $i++;
    }
endforeach;
echo "</form>";
?>
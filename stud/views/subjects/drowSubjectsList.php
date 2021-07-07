<font size = '5' color = 'red'><b> Выберите предмет <b></font></br>
<?php
$i = 0;
foreach ($subjectsList as $subjectItem):
    {
       $sub_id = $subjectItem['subject_id'];
       $sub_name = $subjectItem['subject_name'];
       if ($_SESSION['subject_list_reason'] == 'change_subject')
         echo "<a href = '/subjects/changeAcceptedSubject/$sub_id'> $sub_name </br></a>";
       else if ($_SESSION['subject_list_reason'] == 'change_theme')
         echo "<a href = '/themes/changeAcceptedThemeBySubject/$sub_id'> $sub_name </br></a>";
       else if ($_SESSION['subject_list_reason'] == 'result_exam')
         echo "<a href = '/exams/resultExamToSubject/$sub_id'> $sub_name </br></a>";
       else if ($_SESSION['subject_list_reason'] == 'add_question')
         echo "<a href = '/questions/addQuestionToSubject/$sub_id'> $sub_name </br></a>";
       else if ($_SESSION['subject_list_reason'] == 'change_question')
         echo "<a href = '/questions/changeQuestionToSubject/$sub_id'> $sub_name </br></a>";
       $i++;
    }
endforeach;
echo "</form>";
?>
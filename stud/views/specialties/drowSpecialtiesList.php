<font size = '5' color = 'red'><b> Выберите специальность <b></font></br>
<?php
foreach ($specialitysList as $specialityItem):
    {
       $speciality_id = $specialityItem['speciality_id'];
       $speciality_name = $specialityItem['speciality_name'];
       if ($_SESSION['speciality_list_reason'] == 'add_exam')
         echo "<a href = '/exams/addExamToSpec/$speciality_id'> $speciality_name </br></a>";
       else if ($_SESSION['speciality_list_reason'] == 'change_theme')
         echo "<a href = '/themes/changeAcceptedThemeByspeciality/$speciality_id'> $speciality_name </br></a>";
      else if ($_SESSION['speciality_list_reason'] == 'input_result_exam')
         echo "<a href = '/exams/resultExamToSpec/$speciality_id/1'> $speciality_name </br></a>";
      else if ($_SESSION['speciality_list_reason'] == 'watch_result_exam')
         echo "<a href = '/exams/resultExamToSpec/$speciality_id/2'> $speciality_name </br></a>";
    
    }
endforeach;
echo "</form>";
?>
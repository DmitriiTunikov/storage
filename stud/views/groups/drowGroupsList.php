<font size = '5' color = 'red'><b> Выберите группу <b></font></br>
<?php
if ($_SESSION['groups_list_reason'] == 'watch_results')
{
  echo "<form method = 'post' action = '/exams/watchExamToGroup'>";
  echo "с <input type = date name = 'start_date'> по <input type = date name = 'end_date'></br>";
  echo "<select name = 'group'>";
}
foreach ($groupsList as $groupItem):
    {
       $group_id = $groupItem['group_id'];
       $group_name = $groupItem['course'].$groupItem['university'].$groupItem['department'].'/'.$groupItem['group_num'];
       if ($_SESSION['groups_list_reason'] == 'add_exam')
         echo "<a href = '/exams/addExamToGroup/$group_id'> $group_name </br></a>";
       else if ($_SESSION['groups_list_reason'] == 'change_theme')
         echo "<a href = '/themes/changeAcceptedThemeBygroup/$group_id'> $group_name </br></a>";
       else if ($_SESSION['groups_list_reason'] == 'result_exam')
         echo "<a href = '/exams/resultExamToGroup/$group_id'> $group_name </br></a>";
       else if ($_SESSION['groups_list_reason'] == 'watch_results')
       {
         echo "<option value = '$group_id'>$group_name</option>";
         //echo "<a href = '/exams/watchExamToGroup/$group_id'> $group_name </br></a>";
       }
    }
endforeach;
if ($_SESSION['groups_list_reason'] == 'watch_results')
{
  echo "</select></br>";
  echo "<input type = submit name = 'group_but value ='Показать экзамены'></form>";
}
echo "</form>";
?>
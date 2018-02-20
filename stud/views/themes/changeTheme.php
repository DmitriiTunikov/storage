<?php
echo "<form method = 'post' action = '/themes/changeThemeToBase/'>
<input type = submit name = 'delete_theme' value = 'Удалить тему'/></br>
<input name = 'theme_id' value = '$theme_id' readonly/> ID </br>
<input name = 'theme_name' value = '$cur_theme_name'/> Название темы</br>
<input type = submit name = 'change_theme' value = 'Изменить тему'/></br>";
$i = 0;
$state = 0;
foreach ($subjectList as $subjectItem):
    {
       $subject_id = $subjectItem['subject_id'];
       $subject_name = $subjectItem['subject_name'];
       $state = 0;
       foreach ($checkedSubject as $checkSubjectItem):
       {
           if ($checkSubjectItem == $subject_id)
           {
             echo "<input type = 'radio' name = 'subject' value = '$subject_id' checked = 'checked'> $subject_name </br>";  
             $state = 1;
           }      
       }
       endforeach;

        if (!$state)
          echo "<input type = 'radio' name = 'subject' value = '$subject_id'> $subject_name </br>"; 
        }
endforeach;
echo "</form>";
?>
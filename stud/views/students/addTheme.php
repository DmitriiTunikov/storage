<?php
echo "<form method = 'post' action = '/themes/addThemeToBase/'>
<input name = 'theme_name'/> Название темы</br>
<input type = submit name = 'add_theme' value = 'Добавить тему'/></br>";
$i = 0;
foreach ($subjectList as $subjectItem):
    {
       $subject_id = $subjectItem['subject_id'];
       $subject_name = $subjectItem['subject_name'];
       echo "<input name = 'subject' value = '$subject_id' type = 'radio' value = 'dsa'> $subject_name </br>"; 
    }
endforeach;
echo "</form>";
?>
<?php
echo "<form method = 'post' action = '/questions/changeQuestionToBase/'>
<input type = submit name = 'delete_question' value = 'Удалить вопрос'/></br>
<input name = 'question_id' value = '$question_id' readonly/> ID </br>
<input name = 'question_name' value = '$cur_question_name'/> Название вопроса</br>
<input type = submit name = 'change_question' value = 'Изменить вопрос'/></br>";
$i = 0;
$state = 0;
foreach ($themeList as $themeItem):
    {
       $theme_id = $themeItem['theme_id'];
       $theme_name = $themeItem['theme_name'];
       $state = 0;
       foreach ($checkedTheme as $checkthemeItem):
       {
           if ($checkthemeItem == $theme_id)
           {
             echo "<input type = 'radio' name = 'theme' value = '$theme_id' checked = 'checked'> $theme_name </br>";  
             $state = 1;
           }      
       }
       endforeach;

        if (!$state)
          echo "<input type = 'radio' name = 'theme' value = '$theme_id'> $theme_name </br>"; 
        }
endforeach;
echo "</form>";
?>
<?php
echo "<form method = 'post' action = '/questions/addQuestionToBase/'>
<input name = 'question_text'/> Текст вопроса </br>
<input type = submit name = 'add_question' value = 'Добавить вопрос'/></br>";
$i = 0;
foreach ($themesList as $themeItem):
    {
       $theme_id = $themeItem['theme_id'];
       $theme_name = $themeItem['theme_name'];
       echo "<input name = 'theme' value = '$theme_id' type = 'radio'> $theme_name </br>"; 
    }
endforeach;
echo "</form>";
?>
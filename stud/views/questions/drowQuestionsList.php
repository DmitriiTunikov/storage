<font size = '5' color = 'red'><b> Выберите вопрос <b></font></br>
<?php
foreach ($questionsList as $questionsItem):
    {
       $question_id = $questionsItem['question_id'];
       $question_name = $questionsItem['question_text'];
       //$theme_id = $questionsItem['theme_id'];
       
       echo "<a href = '/questions/changeAcceptedQuestion/$question_id'> $question_name </br>";
    }
endforeach;
echo "</form>";
?>
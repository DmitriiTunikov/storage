<?php
echo "<form method = 'post' action = '/subjects/addSubjectToBase/'>
<input name = 'subject_name'/> Название предмета</br>
<input type = submit name = 'add_subject' value = 'Добавить предмет'/></br>";
$i = 0;
foreach ($specList as $specItem):
    {
       $spec_id = $specItem['speciality_id'];
       $spec_name = $specItem['speciality_name'];
       echo "<input type = checkbox name = '$spec_id'> $spec_name </br>"; 
    }
endforeach;
echo "</form>";
?>
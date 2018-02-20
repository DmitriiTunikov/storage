<?php
echo "<form method = 'post' action = '/subjects/changeSubjectToBase/'>
<input name = 'subject_id' value = '$subject_id' readonly/> ID </br>
<input name = 'subject_name' value = '$cur_subject_name'/> Название предмета</br>
<input type = submit name = 'change_subject' value = 'Изменить предмет'/></br>";
$i = 0;
$state = 0;
foreach ($specList as $specItem):
    {
       $spec_id = $specItem['speciality_id'];
       $spec_name = $specItem['speciality_name'];
       $state = 0;
       foreach ($checkedSpec as $checkSpecItem):
       {
           if ($checkSpecItem == $spec_id)
           {
             echo "<input type = checkbox name = '$spec_id' checked = 'checked'> $spec_name </br>";  
             $state = 1;
           }      
       }
       endforeach;

        if (!$state)
          echo "<input type = checkbox name = '$spec_id'> $spec_name </br>"; 
        }
endforeach;
echo "</form>";
?>
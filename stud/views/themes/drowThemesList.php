<font size = '5' color = 'red'><b> Выберите тему <b></font></br>
<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

foreach ($themesList as $themesItem):
    {
       $theme_id = $themesItem['theme_id'];
       $theme_name = $themesItem['theme_name'];
       if ($_SESSION['themes_list_reason'] == 'change_theme')
       {
        echo "<a href = '/themes/changeAcceptedTheme/$theme_id'> $theme_name </br>";    
       }
       else if($_SESSION['themes_list_reason'] == 'change_question')
         echo "<a href = '/questions/changeAcceptedQuestionByTheme/$theme_id'> $theme_name </br>";
    }
endforeach;
echo "</form>";
?>
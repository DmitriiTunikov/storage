<?php
MainPage();
function MainPage()
  {
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    echo "<html>
<style>
  body { background: url(pictures/in3.jpg); }
</style>
    <body>
        <a href = 'tests/test_results.php' align = 'center'> <b><font size = '5'color = 'green'> Результаты тестов </b></a><br></font>
        <a href = 'tests/hard_questions.php' align = 'center'> <b><font size = '5'color = 'green'> Самые сложные вопросы </b></a><br></font>
      ";
  }
?>
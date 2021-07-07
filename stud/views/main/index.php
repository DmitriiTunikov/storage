<?php
MainPage();
function MainPage()
  {
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $_SESSION['name'] = 'sasd';

    
    
    echo "<html>

    <body>
    <a href = '/exams/addExam/' align = 'center'> <b><font size = '5'color = 'green'> 1) Поставить новый экзамен группе </b></a><br></font>
    <a href = '/subjects/subjectsInstruments/' align = 'center'> <b><font size = '5'color = 'green'> 2) Добавить(изменить) предметы </b></a><br></font>
    <a href = '/themes/themesInstruments/' align = 'center'> <b><font size = '5'color = 'green'> 3) Добавить(изменить) темы </b></a><br></font>
    <a href = '/questions/questionsInstruments/' align = 'center'> <b><font size = '5'color = 'green'> 4) Добавить(изменить) вопросы </b></a><br></font>
		<a href = '/exams/inputResultExam/' align = 'center'> <b><font size = '5'color = 'green'> 5) Внести результаты экзамена </b></a><br></font>
    <a href = '/exams/watchResults/' align = 'center'> <b><font size = '5'color = 'green'> 6) Просмотр результатов экзаменов </b></a><br></font>
    <a href = '/exams/watchBestGroups/' align = 'center'> <b><font size = '5'color = 'green'> 7) Самые лучшие группы </b></a><br></font>
      "
      ;
  }?>
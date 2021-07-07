<?php
return array(

	'news/([0-9]+)' => 'news/view/$1',
	'news' => 'news/index', 
	'main' => 'main/mainPage',
	'exams/addExam' => 'exams/addExam',
	'subjects/subjectsInstruments' => 'subjects/subjectsInstruments',
	'subjects/addSubjects' => 'subjects/addSubjects',
	'subjects/changeSubjects' => 'subjects/changeSubject',
	'subjects/changeAcceptedSubject/([0-9]+)' =>  'subjects/changeAcceptedSubject/$1',
	'subjects/changeSubjectToBase' => 'subjects/changeSubjectToBase',
	'subjects/addSubjectToBase' => 'subjects/addSubjectToBase',

	'themes/themesInstruments' => 'themes/themesInstruments',
	'questions/questionsInstruments' => 'questions/questionsInstruments',
	
    'instruments' => 'exams/showInstruments',
	);
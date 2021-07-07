<?php
return array(
	'main' => 'main/mainPage',
//Subjects	
	'subjects/subjectsInstruments' => 'subjects/subjectsInstruments',
	'subjects/addSubjects' => 'subjects/addSubjects',
	'subjects/changeSubjects' => 'subjects/changeSubjects',
	'subjects/changeAcceptedSubject/([0-9]+)' =>  'subjects/changeAcceptedSubject/$1',
	'subjects/changeSubjectToBase' => 'subjects/changeSubjectToBase',
	'subjects/addSubjectToBase' => 'subjects/addSubjectToBase',
//Themes
	'themes/themesInstruments' => 'themes/themesInstruments',
	'themes/addThemes' => 'themes/addThemes',
	'themes/changeThemes' => 'themes/changeTheme',
	'themes/changeAcceptedTheme/([0-9]+)' =>  'themes/changeAcceptedTheme/$1',
	'themes/changeThemeToBase' => 'themes/changeThemeToBase',
	'themes/addThemeToBase' => 'themes/addThemeToBase',
	'themes/changeAcceptedThemeBySubject/([0-9]+)' => 'themes/changeAcceptedThemeBySubject/$1',
//questions 
    'questions/changeQuestionToSubject/([0-9]+)'=>'questions/changeQuestionToSubject/$1',
    'questions/addQuestionToSubject/([0-9]+)' => 'questions/addQuestionToSubject/$1',
	'questions/questionsInstruments' => 'questions/questionsInstruments',
	'questions/addQuestions' => 'questions/addQuestion',
	'questions/changeQuestions' => 'questions/changeQuestion',
	'questions/changeAcceptedQuestion/([0-9]+)' =>  'questions/changeAcceptedQuestion/$1',
	'questions/changeQuestionToBase' => 'questions/changeQuestionToBase',
	'questions/addQuestionToBase' => 'questions/addQuestionToBase',
	'questions/changeAcceptedQuestionByTheme/([0-9]+)' => 'questions/changeAcceptedQuestionByTheme/$1',
//exams
    'exams/inputResultExam' => 'exams/inputResultExam',
	'exams/addExam' => 'exams/addExam',
	'exams/checkExam/([0-9]+)' => 'exams/checkExam/$1',
	'exams/addExamToSpec/([0-9]+)/([0-9]+)' => 'exams/addExamToSpec/$1/$2',
	'exams/resultExamToSubject/([0-9]+)' => 'exams/resultExamToSubject/$1',
	'exams/resultExamToSpec/([0-9]+)' => 'exams/resultExamToSpec/$1',
	'exams/addExamToGroup/([0-9]+)' => 'exams/addExamToGroup/$1',
	'exams/resultExamToStudent/([0-9]+)/([0-9]+)' => 'exams/resultExamToStudent/$1/$2',
	'exams/resultExamToGroup/([0-9]+)' => 'exams/resultExamToGroup/$1',
	'instruments' => 'exams/showInstruments',
	'exams/resultExamToBase' => 'exams/resultExamToBase',
	'exams/watchResults' => 'exams/watchResults',
	'exams/watchBestGroups' => 'exams/watchBestGroups',
	//'exams/watchExamToGroup/([0-9]+)' => 'exams/watchExamToGroup/$1',
	'exams/watchExamToGroup' => 'exams/watchExamToGroup',
	'exams/watchResultsExam/([0-9]+)/([0-9]+)' => 'exams/watchResultsExam/$1/$2',
//test
	'test/index' => 'test/index',
	'test/search' => 'test/search',
	'test/add' => 'test/add',
	'test/edit' => 'test/edit',
	'test/compress/([0-9]+)' => 'test/compress/$1',
	'test/addm' => 'test/addm',
	
	);
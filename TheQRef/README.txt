<--->
if you use Apache in httpd.conf find "DocumentRoot" and position in .../htdocs/TheQRef and do the same for Directory

<--->
in folder "Controller" class "RetrieveImageController" variable $apsolutePathToImage must be set to folder
where pictures are stored locally

<--->
SQL file is in root folder

<--->
When creating quiz there are 3 types of questions
there are 3 types of questions:
1->only one correct answer,
	for example: "question{1}:answer1,answer2,...,answerN=correctAnswer;"
2->more correct answers
	for example: "question{2}:answer1,answer2,..,answerN=correctAnswer1,...,correctAnswerN;"
3->type of question where user type in answer,there are no offered questions you only set correct question
	for example: "question{3}:correctAnswer;"

**DO NOT FORGET TO PUT ";" AFTER EACH QUESTION, EVEN THE LAST ONE**


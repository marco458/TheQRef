<?php


namespace controller;

use Model\Quiz;
use Model\Score;
use Model\User;
use view\EditView;
use view\HeaderView;

class EditController extends AbstractController
{

    protected function doJob()
    {
        session_start();
        $segments = explode('/', $_SERVER['REQUEST_URI']);
        $quizId= $segments[2];

        if(isset($_POST["deleteQuiz"])) {
            $quiz = new Quiz();
            $quiz->deleteQuiz($quizId);
            header('Location:/Home');
        }

        if(isset($_POST["editQuiz"])) {
            $isPublic = 0;
            if(isset($_POST["isPublic"])) {
                $isPublic = 1;
            }
            $enableComments = 0;
            if(isset($_POST["enableComments"])) {
                $enableComments = 1;
            }
            $quiz = new Quiz();
            $quiz->update($quizId,$_POST["quizDescription"],$_POST["quizContent"],$isPublic,$enableComments);
        }

        $header = new HeaderView();
        $header->generateHTML();

        $score = new Score();
        $comments = $score->getComments($quizId);

        $quiz = new Quiz();
        $quizData = $quiz->getQuizWithID($quizId);

        $user = new User();
        $userData = $user->getInfoWithId($_SESSION["userId"]);

        $edit = new EditView($userData,$quizData,$comments);
        $edit->generateHTML();


    }
}
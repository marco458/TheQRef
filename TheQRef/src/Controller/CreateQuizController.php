<?php


namespace controller;


use Model\Quiz;
use view\CreateQuizView;
use view\HeaderView;

class CreateQuizController extends AbstractController
{

    protected function doJob()
    {
        if($_POST["createQuiz"] == "") {
            $view = new HeaderView();
            $view->generateHTML();
            $view = new CreateQuizView();
            $view->generateHTML();
            return;
        }
        if($_POST["quizName"] == "" || $_POST["quizDescription"] == "") {
            $view = new HeaderView();
            $view->generateHTML();
            $view = new CreateQuizView("please fill in required fields!");
            $view->generateHTML();
            return;
        }

        if($_FILES["quizFile"]["name"] == "" && $_POST["quizContent"] == "") {
            $view = new HeaderView();
            $view->generateHTML();
            $view = new CreateQuizView("you need to select file with quiz questions or fill the textarea!");
            $view->generateHTML();
            return;
        }
        if($_FILES["quizFile"]["name"] != "" && $_POST["quizContent"] != "") {
            $view = new HeaderView();
            $view->generateHTML();
            $view = new CreateQuizView("please create a quiz in only one way!");
            $view->generateHTML();
            return;
        }

        //let's save a new quiz
        $questions = "";
        if($_POST["quizContent"] != "") {
            $questions = $_POST["quizContent"];
        }
        if($_FILES["quizFile"]["name"] != "") {
            $questions = file_get_contents($_FILES["quizFile"]["tmp_name"]);
        }

        $public = 0;
        $comments = 0;
        if(isset($_POST["isPublic"])) {
            $public = 1;
        }
        if(isset($_POST["enableComments"])) {
            $comments = 1;
        }
        session_start();
        $quiz = new Quiz();
        $quiz->insert($_SESSION["userId"],$_POST["quizName"],$_POST["quizDescription"],
            $questions,$public,$comments);


        $view = new HeaderView();
        $view->generateHTML();



    }
}
<?php


namespace controller;


use Model\Score;

class CommentController extends AbstractController
{

    public function __construct() {

    }

    protected function doJob()
    {

        $segments = explode('/', $_SERVER['REQUEST_URI']);
        session_start();

        $_POST["commentContent"] = htmlentities($_POST["commentContent"]);

        $score = new Score();
        //we will save only logged user
        if($_SESSION["userId"] >= 0) {
            $score->update($_POST["commentContent"]);
        }
        header('Location:/Home');

    }
}
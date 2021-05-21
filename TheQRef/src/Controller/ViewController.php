<?php


namespace controller;


use Model\Quiz;
use Model\User;
use view\HeaderView;
use view\ViewView;

class ViewController extends AbstractController
{

    protected function doJob()
    {
        $view = new HeaderView();
        $view->generateHTML();

        $quiz = new Quiz();
        $data = $quiz->getQuiz($_SESSION["userId"]);

        $view = new ViewView($data,true);
        $view->generateHTML();

        //tu cemo opet pozvati view->generate html za sve ostale kvizove koji nisu od korisnika

        $quiz = new Quiz();
        $data = $quiz->getAll($_SESSION["userId"]);
        $view = new ViewView($data);
        $view->generateHTML();

    }
}
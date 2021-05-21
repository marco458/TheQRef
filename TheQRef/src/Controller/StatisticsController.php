<?php


namespace controller;


use Model\Quiz;
use view\HeaderView;
use view\StatisticsView;

class StatisticsController extends AbstractController
{

    protected function doJob()
    {
        $view = new HeaderView();
        $view->generateHTML();

        session_start();
        $quiz = new Quiz();
        $data = $quiz->getStatistics();

        $view = new StatisticsView($data);
        $view->generateHTML();


    }
}
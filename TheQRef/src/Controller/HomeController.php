<?php


namespace controller;


use view\HeaderView;

class HomeController extends AbstractController
{

    protected function doJob()
    {
        $view = new HeaderView();
        $view->generateHTML();
    }
}
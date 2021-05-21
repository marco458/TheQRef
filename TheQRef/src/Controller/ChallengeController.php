<?php


namespace controller;


use view\HeaderView;

class ChallengeController extends AbstractController
{

    protected function doJob()
    {
        $view = new HeaderView();
        $view->generateHTML();

        $p = new \HTMLTextNode("Unfinished part :)");
        $div = new \HTMLDivElement();
        $atr = new \HTMLAttribute("style","font-size:25px; padding:20px;");
        $div->add_attribute($atr);
        $div->add_child($p);

        echo $div->get_html();
    }
}
<?php


namespace view;


use Model\Parser;

class QuizView extends AbstractView
{
    private $quizData = [];
    private $userData = [];

    public function __construct($quizData,$userData) {
        $this->quizData = $quizData;
        $this->userData = $userData;
    }

    public function generateHTML()
    {

        $name = $this->userData[0];
        $surname = $this->userData[1];

        $quizName = $this->quizData["QuizName"];
        $quizDesription = $this->quizData["QuizDescription"];
        $isPublic = $this->quizData["isPublic"];
        $area = "private";
        if($isPublic == 1) {
            $area = "public";
        }

        $div = new \HTMLDivElement();
        $p = new \HTMLTextNode("Creator: " .$name ." ");
        $div->add_child($p);
        $p = new \HTMLTextNode($surname."<br>");
        $div->add_child($p);

        $div1 = new \HTMLDivElement();
        $p = new \HTMLTextNode("this is a $area quiz");
        $div1->add_child($p);
        $atr = new \HTMLAttribute("style","margin:3px; font-size:15px;");
        $div1->add_attribute($atr);
        $div->add_child($div1);

        $atr = new \HTMLAttribute("style","margin:15px; font-size:20px;");
        $div->add_attribute($atr);
        echo $div;

        $div = new \HTMLDivElement();
        $div1 = new \HTMLDivElement();
        $p = new \HTMLTextNode($quizName);
        $atr = new \HTMLAttribute("style","margin:5px; font-size:25px;");
        $div1->add_attribute($atr);
        $div1->add_child($p);
        $div2 = new \HTMLDivElement();
        $p = new \HTMLTextNode($quizDesription);
        $div2->add_child($p);
        $atr = new \HTMLAttribute("style","display:flex; flex-flow:column;
        align-items:center; justify-content: center;");
        $div->add_attribute($atr);
        $div->add_child($div1);
        $div->add_child($div2);
        echo $div->get_html();

        $a = new \HTMLAElement("/Home","");
        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/homepage");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("width", "100px");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("height", "100px");
        $img->add_attribute($atr);
        $a->add_child($img);
        $atr = new \HTMLAttribute("style","position:fixed; top:0; right:0; margin: 30px;");
        $a->add_attribute($atr);
        echo $a;

        //lets make a questions
        $questions = Parser::parse($this->quizData["QuizQuestions"]);
        $form = new \HTMLFormElement();
        $atr = new \HTMLAttribute("action", $_SERVER['REQUEST_URI']);
        $form->add_attribute($atr);
        $atr = new \HTMLAttribute("method", "POST");
        $form->add_attribute($atr);


        $i = 1;
        for($k = 0; $k < count($questions)-1; $k++) {
            $question = $questions[$k];
            $text = $question["questionAndType"][0];
            $text = trim($text);
            $type = $question["questionAndType"][1];
            $answers = [];
            foreach ($question["answers"][0] as $x) {
                array_push($answers,$x);
            }

            $div = new \HTMLDivElement();
            $p = new \HTMLTextNode($k+1 .". " .ucfirst($text) ."?"."<br>");
            $div->add_child($p);

            if($type == 1) {
                foreach ($answers as $elem) {
                    $in = new \HTMLInputElement();
                    $atr = new \HTMLAttribute("type", "radio");
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute("name", $i);
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute("value", $elem);
                    $in->add_attribute($atr);
                    $div->add_child($in);
                    $p = new \HTMLTextNode($elem."<br>");
                    $div->add_child($p);
                }
                $i++;
            }
            if($type == 2) {
                foreach ($answers as $elem) {
                    $in = new \HTMLInputElement();
                    $atr = new \HTMLAttribute("type", "checkbox");
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute("name", $i);
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute("value", $elem);
                    $in->add_attribute($atr);
                    $div->add_child($in);
                    $p = new \HTMLTextNode($elem."<br>");
                    $div->add_child($p);
                    $i++;
                }
            }

            if($type == 3) {
                $in = new \HTMLInputElement();
                $atr = new \HTMLAttribute("type", "text");
                $in->add_attribute($atr);
                $atr = new \HTMLAttribute("name", $i);
                $in->add_attribute($atr);
                $atr = new \HTMLAttribute("style","display:block;");
                $in->add_attribute($atr);
                $div->add_child($in);
                $i++;
            }

            $atr = new \HTMLAttribute("style","margin:5px;");
            $div->add_attribute($atr);

            $p = new \HTMLTextNode("<br>");
            $div->add_child($p);
            $form->add_child($div);

       }

        $atr = new \HTMLAttribute("style","display:flex; flex-flow:column; margin-left: 1%;");
        $form->add_attribute($atr);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("type","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","submitQuiz");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","Submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px; margin-left:6px;  width:150px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $p = new \HTMLTextNode("<br><br>");
        $form->add_child($p);

        echo $form->get_html();
        return;
    }
}
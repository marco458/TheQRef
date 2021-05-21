<?php


namespace view;


use Model\User;

class EditView extends AbstractView
{
    private $userData = [];
    private $quizData = [];
    private $comments = [];

    public function __construct($userData,$quizData,$comments) {
        $this->userData = $userData;
        $this->quizData = $quizData;
        $this->comments = $comments;
    }

    public function generateHTML()
    {

        foreach ($this->quizData as $row) {
            $quizName = $row["QuizName"];
            $isPublic = $row["isPublic"];
            $quizQuestions = $row["QuizQuestions"];
            $enabledComments =  $row["enableComments"];
            $desc = $row["QuizDescription"];
        }

        $div = new \HTMLDivElement();
        $p = new \HTMLTextNode($quizName);
        $div->add_child($p);
        $atr = new \HTMLAttribute("style","font-size:40px; font-weight:549; margin:15px;");
        $div->add_attribute($atr);
        echo $div->get_html();

        $form = new \HTMLFormElement();
        $atr = new \HTMLAttribute("action",$_SERVER['REQUEST_URI']);
        $form->add_attribute($atr);
        $atr = new \HTMLAttribute("method","POST");
        $form->add_attribute($atr);


        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","Quiz Description");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","quizDescription");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("maxlength","100");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value",$desc);
        $in->add_attribute($atr);
        $form->add_child($in);

        $div = new \HTMLDivElement();
        $p = new \HTMLTextNode(" Please read README before making the quiz for info on question format <br>");
        $div->add_child($p);
        $form->add_child($div);

        $in = new \HTMLTextAreaElement();
        $atr = new \HTMLAttribute("placeholder","Quiz Text Area");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","quizContent");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("rows","10");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("cols","100");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $p = new \HTMLTextNode($quizQuestions);
        $in->add_child($p);
        $form->add_child($in);

        $label = new \HTMLLabelElement();
        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("name","isPublic");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("type","checkbox");
        $in->add_attribute($atr);
        if($isPublic == 1) {
            $atr = new \HTMLAttribute("checked","");
            $in->add_attribute($atr);
        }
        $text = new \HTMLTextNode("public quiz");
        $label->add_child($text);
        $label->add_child($in);
        $form->add_child($label);

        $label = new \HTMLLabelElement();
        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("name","enableComments");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("type","checkbox");
        $in->add_attribute($atr);
        if($enabledComments == 1) {
            $atr = new \HTMLAttribute("checked","");
            $in->add_attribute($atr);
        }
        $text = new \HTMLTextNode("enableComments");
        $label->add_child($text);
        $label->add_child($in);
        $form->add_child($label);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("type","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","editQuiz");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","UpdateQuiz");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px; width:150px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("type","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","deleteQuiz");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","DeleteQuiz");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px; width:150px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $atr = new \HTMLAttribute("style","display:flex; 
        flex-flow: column;");
        $form->add_attribute($atr);

        $div = new \HTMLDivElement();
        $atr = new \HTMLAttribute("style","display:flex; justify-content: center;
        margin:15px;");
        $div->add_attribute($atr);

        $div->add_child($form);
        echo $div->get_html();





        //Add comments
        if($enabledComments == 1) {
            $numberOfComments = 0;
            foreach ($this->comments as $row) {
                if($row["Comment"] != "") {
                    $numberOfComments++;
                }
            }

            $div = new \HTMLDivElement();
            $div1 = new \HTMLDivElement();
            $p = new \HTMLTextNode($numberOfComments . " Comments:");
            $div1->add_child($p);
            $atr = new \HTMLAttribute("style", "font-size:35px;");
            $div1->add_attribute($atr);

            $div->add_child($div1);
            $user = new User();

            foreach ($this->comments as $row) {
                if($row["Comment"] != "") {
                    $div1 = new \HTMLDivElement();

                    $div2 = new \HTMLDivElement();
                    $atr = new \HTMLAttribute("style", "font-size: 25px; margin-top:20px;");
                    $div2->add_attribute($atr);

                    $data = $user->getInfo($row["UserId"]);
                    $p = new \HTMLTextNode($data[0] . " " . $data[1] . "<br>");
                    $div2->add_child($p);
                    $div1->add_child($div2);

                    $atr = new \HTMLAttribute("", "");
                    //     echo "prvi=" .$row["Comment"][0] ."= zadnji " .$row["Comment"][strlen($row["Comment"])-1]."=<br>";
                    if ($row["Comment"][0] == $row["Comment"][strlen($row["Comment"]) - 1]) {
                        if ($row["Comment"][0] == "*") {
                            $atr = new \HTMLAttribute("style", "font-weight: bolder; font-size:large;");
                            $row["Comment"] = substr($row["Comment"], 1, strlen($row["Comment"]) - 2);
                        }
                        if ($row["Comment"][0] == "_") {
                            $atr = new \HTMLAttribute("style", "text-decoration: underline;");
                            $row["Comment"] = substr($row["Comment"], 1, strlen($row["Comment"]) - 2);
                        }
                    }
                    $div3 = new \HTMLDivElement();
                    $p = new \HTMLTextNode(" " . $row["Comment"] . "<br>");
                    $div3->add_child($p);
                    $div3->add_attribute($atr);
                    $div1->add_child($div3);
                    $div->add_child($div1);
                }
            }

            $atr = new \HTMLAttribute("style", "display:flex; flex-flow:column;
        align-items: flex-start; margin-left: 15px;");
            $div->add_attribute($atr);

            echo $div->get_html();
        }
        //******************************

    }
}
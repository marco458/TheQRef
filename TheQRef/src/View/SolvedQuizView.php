<?php


namespace view;


use Model\Parser;
use Model\User;

class SolvedQuizView extends AbstractView
{

    private $quizData = [];
    private $userData = [];
    private $userAnsweredCorrect = [];
    private $correctAnswers = [];
    private $userAnswers = [];
    private $correct = 0;
    private $userAnsweredQuestion = 0;
    private $score = 0;
    private $comments = [];

    public function __construct($quizData,$userData,$userAnsweredCorrect = [],$correctAnswers = [],$userAnswers = [],
                                $correct = 0,$userAnsweredQuestion=0,$score = 0,$comments = []) {
        $this->quizData = $quizData;
        $this->userData = $userData;
        $this->userAnsweredCorrect = $userAnsweredCorrect;
        $this->correctAnswers = $correctAnswers;
        $this->userAnswers = $userAnswers;
        $this->correct = $correct;
        $this->userAnsweredQuestion = $userAnsweredQuestion;
        $this->score = $score;
        $this->comments = $comments;
    }
    public function generateHTML()
    {

        $name = $this->userData[0];
        $surname = $this->userData[1];
        $quizName = $this->quizData["QuizName"];
        $quizDesription = $this->quizData["QuizDescription"];
        $quizId = $this->quizData["QuizId"];
        $isPublic = $this->quizData["isPublic"];
        $enabledComments = $this->quizData["enableComments"];
        $area = "private";
        if($isPublic == 1) {
            $area = "public";
        }

        $div = new \HTMLDivElement();
        $p = new \HTMLTextNode("Creator: ".$name ." ");
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

        //**********************************+

        $div = new \HTMLDivElement();
        $p = new \HTMLTextNode("Answered questions: " .$this->userAnsweredQuestion ." ");
        $div->add_child($p);
        $p = new \HTMLTextNode("Number of correct Answers: " .$this->correct ." ");
        $div->add_child($p);
        $p = new \HTMLTextNode("Score: ".$this->score." %");
        $div->add_child($p);
        $atr = new \HTMLAttribute("style","display:flex; align-items:center; justify-content:center;
            border: 1px solid black; font-size: 25px; padding:15px;");
        $div->add_attribute($atr);

        echo $div->get_html();



        //lets make a questions
        $questions = Parser::parse($this->quizData["QuizQuestions"]);
        $form = new \HTMLFormElement();
        $atr = new \HTMLAttribute("action", "/Comment/".$quizId);
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
                    $checked = "";
                    foreach ($this->userAnswers as $x) {
                        if($x == $elem) {
                            $checked = "checked";
                            break;
                        }
                    }
                    $in = new \HTMLInputElement();
                    $atr = new \HTMLAttribute("type", "radio");
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute("name", $i);
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute("value", $elem);
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute($checked,"");
                    $in->add_attribute($atr);
                    $div->add_child($in);
                    $p = new \HTMLTextNode($elem);
                    $div->add_child($p);

                    if($this->userAnsweredCorrect[$k] == 0 && $this->correctAnswers[$k]==$elem) {
                        $p = new \HTMLTextNode(" ");
                        $div->add_child($p);
                        $img = new \HTMLImgElement();
                        $atr = new \HTMLAttribute("src", "/picture/check");
                        $img->add_attribute($atr);
                        $atr = new \HTMLAttribute("width", "20px");
                        $img->add_attribute($atr);
                        $atr = new \HTMLAttribute("style", "");
                        $img->add_attribute($atr);
                        $div->add_child($img);
                    }
                    $p = new \HTMLTextNode("<br>");
                    $div->add_child($p);
                }
                $i++;
            }
            if($type == 2) {
                foreach ($answers as $elem) {
                    $checked = "";
                    $check = false;
                    foreach ($this->userAnswers as $x) {
                        if($x == $elem) {
                            $check = true;
                            break;
                        }
                    }
                    if($check) {
                        $checked = "checked";
                    }
                    $in = new \HTMLInputElement();
                    $atr = new \HTMLAttribute("type", "checkbox");
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute("name", $i);
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute("value", $elem ." ");
                    $in->add_attribute($atr);
                    $atr = new \HTMLAttribute($checked,"");
                    $in->add_attribute($atr);
                    $div->add_child($in);
                    $p = new \HTMLTextNode($elem);
                    $div->add_child($p);
                    if($this->userAnsweredCorrect[$k] == 1) {
                        $p = new \HTMLTextNode("<br>");
                        $div->add_child($p);
                    }
                    if($this->userAnsweredCorrect[$k] == 0) {
                        $check = false;
                        foreach ($this->correctAnswers as $x) {
                            if(is_array($x)) {
                                foreach ($x as $v) {
                                    if($elem == $v) {
                                        $check = true;
                                        break;
                                    }
                                }
                            }
                            if($check) {break;}
                        }
                        if($check) {
                            $p = new \HTMLTextNode(" ");
                            $div->add_child($p);
                            $img = new \HTMLImgElement();
                            $atr = new \HTMLAttribute("src", "/picture/check");
                            $img->add_attribute($atr);
                            $atr = new \HTMLAttribute("width", "20px");
                            $img->add_attribute($atr);
                            $atr = new \HTMLAttribute("style", "");
                            $img->add_attribute($atr);
                            $div->add_child($img);

                        }
                        $p = new \HTMLTextNode("<br>");
                        $div->add_child($p);
                    }
                    $i++;
                }
            }

            if($type == 3) {
                $value = $this->correctAnswers[$k];
                $in = new \HTMLInputElement();
                $atr = new \HTMLAttribute("type", "text");
                $in->add_attribute($atr);
                $atr = new \HTMLAttribute("name", $i);
                $in->add_attribute($atr);
                $atr = new \HTMLAttribute("style","display:block;");
                $in->add_attribute($atr);
                $atr = new \HTMLAttribute("value",$value);
                $in->add_attribute($atr);
                $div->add_child($in);
                $i++;
            }

            $p = new \HTMLTextNode("<br>");
            $div->add_child($p);
            $atr = new \HTMLAttribute("style","margin:5px;
                background: linear-gradient(to right, #68f735,#ffffff); ");
            if($this->userAnsweredCorrect[$k] == 0) {
                $atr = new \HTMLAttribute("style","margin:5px; 
                    background: linear-gradient(to right,#ff0000,#ffffff);");
            }

            $div->add_attribute($atr);

            $form->add_child($div);

        }

        if($enabledComments == 1) {
            $div = new \HTMLDivElement();
            $p = new \HTMLTextNode("Write a comment about the quiz");
            $div->add_child($p);
            $atr = new \HTMLAttribute("style", "font-size: 20px; margin-left:2px;");
            $div->add_attribute($atr);
            $form->add_child($div);

            $in = new \HTMLTextAreaElement();
            $atr = new \HTMLAttribute("placeholder", "Comment Text Area");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("name", "commentContent");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("rows", "8");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("cols", "50");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("style", "margin:2px;");
            $in->add_attribute($atr);
            $form->add_child($in);


            $atr = new \HTMLAttribute("style", "display:flex; flex-flow:column; margin-left: 1%;");
            $form->add_attribute($atr);

            $in = new \HTMLInputElement();
            $atr = new \HTMLAttribute("type", "submit");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("name", "submitComment");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("value", "Leave Comment");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("style", "margin:2px; margin-left:6px;  width:150px;");
            $in->add_attribute($atr);
            $form->add_child($in);


            $p = new \HTMLTextNode("<br>");
            $form->add_child($p);

        }
            echo $form->get_html();

        //****************************
        $form = new \HTMLFormElement();
        $atr = new \HTMLAttribute("action", "/Home");
        $form->add_attribute($atr);
        $atr = new \HTMLAttribute("method", "POST");
        $form->add_attribute($atr);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("type","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","Return to homepage");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","width:150px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $atr = new \HTMLAttribute("style"," margin-left:16px;");
        $form->add_attribute($atr);

        $p = new \HTMLTextNode("<br><br>");
        $form->add_child($p);


        echo $form->get_html();

        //Add comments
        if($isPublic == 1) {
            $numberOfComments = 0;
            foreach ($this->comments as $row) {
                if($row["Comment"] != "") {
                    $numberOfComments++;
                }
            }


                $div = new \HTMLDivElement();
                $div1 = new \HTMLDivElement();
                $p = new \HTMLTextNode($numberOfComments . " Comments:");
                if($enabledComments == 1) {
                    $div1->add_child($p);
                }
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
        align-items: flex-start; margin-left: 5px;");
            $div->add_attribute($atr);

            echo $div->get_html();
        }
        return;


    }
}
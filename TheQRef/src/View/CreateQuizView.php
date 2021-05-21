<?php


namespace view;


class CreateQuizView extends AbstractView
{
    private $error = "";

    public function __construct($error = "") {
        $this->error = $error;
    }

    public function generateHTML()
    {
        $form = new \HTMLFormElement();
        $atr = new \HTMLAttribute("action", "/Create");
        $form->add_attribute($atr);
        $atr = new \HTMLAttribute("method", "POST");
        $form->add_attribute($atr);
        $atr = new \HTMLAttribute("enctype", "multipart/form-data");
        $form->add_attribute($atr);

        if($this->error != "") {
            $p = new \HTMLTextNode($this->error);
            $form->add_child($p);
        }

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","Quiz name");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","quizName");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("maxlength","30");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","Quiz Description");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","quizDescription");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("maxlength","100");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $div = new \HTMLDivElement();
        $p = new \HTMLTextNode("Please read README before making the quiz for info on question format <br>");
        $div->add_child($p);
        $form->add_child($div);


        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("name","quizFile");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("type","file");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("accept",".txt");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);


        $in = new \HTMLTextAreaElement();
        $atr = new \HTMLAttribute("placeholder","Quiz Text Area");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","quizContent");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("rows","8");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("cols","50");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $label = new \HTMLLabelElement();
        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("name","isPublic");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("type","checkbox");
        $in->add_attribute($atr);
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
        $text = new \HTMLTextNode("enableComments");
        $label->add_child($text);
        $label->add_child($in);
        $form->add_child($label);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("type","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","createQuiz");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","Create");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
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
    }
}
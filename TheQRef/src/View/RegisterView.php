<?php


namespace view;


class RegisterView extends AbstractView
{
    private $error;
    public function __construct($error = "") {
        $this->error = $error;
    }

    public function generateHTML($name="",$surname="",$date="",$email="",$pass="",$Rpass="") {

        $a = new \HTMLAElement("/","");
        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/homepage");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("width", "100px");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("height", "100px");
        $img->add_attribute($atr);
        $a->add_child($img);
        echo $a->get_html();


        $div = new \HTMLDivElement();

        if($this->error != "") {
            $p = new \HTMLPElement();
            $text = new \HTMLTextNode($this->error);
            $p->add_child($text);
            $div->add_child($p);
        }
        $form = new \HTMLFormElement();
        $atr = new \HTMLAttribute("action","/Register");
        $form->add_attribute($atr);
        $atr = new \HTMLAttribute("method","POST");
        $form->add_attribute($atr);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","Name");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","$name");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","name");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("maxlength","30");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","Surname");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","$surname");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","surname");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("maxlength","30");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("type","date");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("placeholder","Date of birth");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","$date");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","date");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);


        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","Email");
        $in->add_attribute($atr);

        $atr = new \HTMLAttribute("value","$email");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","email");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("maxlength","40");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);


        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","Password");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("type","password");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","$pass");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","password");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("maxlength","30");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);


        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","Repeat password");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("type","password");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","$Rpass");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","repeatPassword");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("maxlength","30");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("type","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","Register");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:2px;");
        $in->add_attribute($atr);
        $form->add_child($in);


        $atr = new \HTMLAttribute("style","display:flex; 
        flex-flow: column; justify-content:center; align-items:center;");
        $form->add_attribute($atr);
        $div->add_attribute($atr);

        $div->add_child($form);

        echo $div->get_html();
    }
}
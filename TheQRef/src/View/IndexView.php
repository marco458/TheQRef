<?php


namespace view;


class IndexView extends AbstractView {



    public function generateHTML() {
        $div = new \HTMLDivElement();

        $form = new \HTMLFormElement();
        $atr = new \HTMLAttribute("action","");
        $form->add_attribute($atr);
        $atr = new \HTMLAttribute("method","POST");
        $form->add_attribute($atr);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","username");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","username");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:5px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("placeholder","password");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("type","password");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","password");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:5px;");
        $in->add_attribute($atr);
        $form->add_child($in);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("type","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","Login");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("name","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:5px;");
        $in->add_attribute($atr);
        $form->add_child($in);




        $div->add_child($form);

        $form = new \HTMLFormElement();
        $atr = new \HTMLAttribute("action","/Register");
        $form->add_attribute($atr);
        $atr = new \HTMLAttribute("method","POST");
        $form->add_attribute($atr);

        $in = new \HTMLInputElement();
        $atr = new \HTMLAttribute("type","submit");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("value","Register");
        $in->add_attribute($atr);
        $atr = new \HTMLAttribute("style","margin:5px;");
        $in->add_attribute($atr);
        $form->add_child($in);



        $div->add_child($form);

        echo $div->get_html();

        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/tasks");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("style","position:absolute; right:50%; bottom:50%; transform: translate(50%,50%);");
        $img->add_attribute($atr);
        echo $img;
    }

}
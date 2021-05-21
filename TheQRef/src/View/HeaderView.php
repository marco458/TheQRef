<?php


namespace view;


use Model\User;

class HeaderView extends AbstractView {




    public function generateHTML() {
        session_start();
        $div = new \HTMLDivElement();
        $a = new \HTMLAElement("/Account","");
        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/settings");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("height", "100px");
        $img->add_attribute($atr);
        $a->add_child($img);
        $div->add_child($a);

        $user = new User();
        $data = $user->getInfo($_SESSION["userId"]);
        $p = new \HTMLPElement();
        $text = new \HTMLTextNode($data[0]);
        $atr = new \HTMLAttribute("style","font-size: 23px;");
        $p->add_attribute($atr);
        $p->add_child($text);
        $div->add_child($p);

        $p = new \HTMLPElement();
        $text = new \HTMLTextNode($data[1]);
        $atr = new \HTMLAttribute("style","font-size: 23px;");
        $p->add_attribute($atr);
        $p->add_child($text);
        $div->add_child($p);

        $a = new \HTMLAElement("/Home","");
        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/homepage");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("height", "100px");
        $img->add_attribute($atr);
        $a->add_child($img);
        $div->add_child($a);

        $a = new \HTMLAElement("/","");
        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/logout");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("height", "100px");
        $img->add_attribute($atr);
        $a->add_child($img);
        $div->add_child($a);

        $atr = new \HTMLAttribute("style","display: flex;
        flex-flow: row;  justify-content: space-around; align-items: center;
        border: solid 2px black; padding: 2px;");
        $div->add_attribute($atr);

        echo $div->get_html();

        $div = new \HTMLDivElement();

        echo "<br>";

        $a = new \HTMLAElement("/Create","");
        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/notes");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("width", "50px");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("height", "50px");
        $img->add_attribute($atr);
        $a->add_child($img);
        $div->add_child($a);

        $a = new \HTMLAElement("/View","");
        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/view");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("width", "50px");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("height", "50px");
        $img->add_attribute($atr);
        $a->add_child($img);
        $div->add_child($a);

        $a = new \HTMLAElement("/Statistics","");
        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/analytics");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("width", "50px");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("height", "50px");
        $img->add_attribute($atr);
        $a->add_child($img);
        $div->add_child($a);

        $a = new \HTMLAElement("/Challenge","");
        $img = new \HTMLImgElement();
        $atr = new \HTMLAttribute("src","/picture/puzzle");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("width", "50px");
        $img->add_attribute($atr);
        $atr = new \HTMLAttribute("height", "50px");
        $img->add_attribute($atr);
        $a->add_child($img);
        $div->add_child($a);

        $atr = new \HTMLAttribute("style","display: flex;
        flex-flow: row;  justify-content: space-around; align-items: center;
        border: solid 2px black; padding: 2px;");
        $div->add_attribute($atr);

        echo $div->get_html();

    }
}
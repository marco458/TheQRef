<?php


namespace view;


class ViewView extends AbstractView
{
    private $data = [];
    private $ownedByUser = false;

    public function __construct($data = [], $ownedByUser = false)
    {
        $this->data = $data;
        $this->ownedByUser = $ownedByUser;
    }

    public function generateHTML()
    {
        /*
        echo "ovdje moramo prikazati sve filmove koje je stvorio korisnik,
        ali i one koje su stvorili i ostali korisnici. Isto tako moramo ponuditi mogucnost
        korisniku da ureduje kvizove koje je on napravio, a i da zaigra neki od kvizova";
        */
        if ($this->ownedByUser) {
            for ($i = 0; $i < count($this->data); $i++) {
                $div = new \HTMLDivElement();
                $quizName = ($this->data[$i])["QuizName"];
                $quizId = ($this->data[$i])["QuizId"];
                if ($i == 0) {
                    $divv = new \HTMLDivElement();
                    $p = new \HTMLTextNode("Owned by me");
                    $divv->add_child($p);
                    $atr = new \HTMLAttribute("style", "margin-top:20px; margin-left:20px;
                     ");
                    $divv->add_attribute($atr);
                    echo $divv->get_html();
                }
                $p = new \HTMLTextNode($quizName);
                $div->add_child($p);

                $form = new \HTMLFormElement();
                $atr = new \HTMLAttribute("action", "/Edit/".$quizId);
                $form->add_attribute($atr);
                $atr = new \HTMLAttribute("method", "POST");
                $form->add_attribute($atr);

                $in = new \HTMLInputElement();
                $atr = new \HTMLAttribute("type", "submit");
                $in->add_attribute($atr);
                $atr = new \HTMLAttribute("name", "submit");
                $in->add_attribute($atr);
                $atr = new \HTMLAttribute("value", "Edit the Quiz");
                $in->add_attribute($atr);
                $atr = new \HTMLAttribute("style", "margin:2px;margin-left:15px;");
                $in->add_attribute($atr);
                $form->add_child($in);

                $div->add_child($form);
                $atr = new \HTMLAttribute("style", "display:flex; 
                justify-content:center; align-items:center; border:solid 1.5px black; margin: 2px;");
                $div->add_attribute($atr);
                echo $div->get_html();
            }
            return;
        }
        for ($i = 0; $i < count($this->data); $i++) {
            $div = new \HTMLDivElement();
            $quizName = ($this->data[$i])["QuizName"];
            $quizId = ($this->data[$i])["QuizId"];
            if ($i == 0) {
                $divv = new \HTMLDivElement();
                $p = new \HTMLTextNode("Owned by other");
                $divv->add_child($p);
                $atr = new \HTMLAttribute("style", "margin-top:20px; margin-left:20px;
                     ");
                $divv->add_attribute($atr);
                echo $divv->get_html();
            }
            $p = new \HTMLTextNode($quizName);
            $div->add_child($p);

            $form = new \HTMLFormElement();
            $atr = new \HTMLAttribute("action", "/Quiz/".$quizId);
            $form->add_attribute($atr);
            $atr = new \HTMLAttribute("method", "POST");
            $form->add_attribute($atr);

            $in = new \HTMLInputElement();
            $atr = new \HTMLAttribute("type", "submit");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("name", "submit");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("value", "Take the Quiz");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("style", "margin:2px; margin-left:15px;");
            $in->add_attribute($atr);
            $form->add_child($in);

            $div->add_child($form);
            $atr = new \HTMLAttribute("style", "display:flex; 
                justify-content:center; align-items:center; border:solid 1.5px black; margin: 2px;");
            $div->add_attribute($atr);
            echo $div->get_html();
        }
    }

}
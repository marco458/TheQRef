<?php


namespace view;


use Model\User;

class AccountView extends AbstractView
{
    private $changePassword;
    private $data = [];

    public function __construct($changePassword=false,$data = []) {
        $this->changePassword = $changePassword;
        $this->data = $data;
    }

    public function generateHTML()
    {
        if(!$this->changePassword) {
            echo "<br>";
            $user = new User();
            $data = $user->getInfo($_SESSION["userId"]);
            $div = new \HTMLDivElement();

            $p = new \HTMLPElement();
            $text = new \HTMLTextNode("Birth date: " .$data[2]);
            $p->add_child($text);
            $div->add_child($p);

            $p = new \HTMLPElement();
            $text = new \HTMLTextNode("E-mail: ".$data[3]);
            $p->add_child($text);
            $div->add_child($p);

            $p = new \HTMLPElement();
            $pass = $_SESSION["password"];
            $text = new \HTMLTextNode("Password: " .$pass);
            $p->add_child($text);
            $div->add_child($p);

            $atr = new \HTMLAttribute("style", "display: flex;
            flex-flow: column;  justify-content: center; align-items: center;
            border: solid 2px black; width:270px; margin-bottom: 9px;");
            $div->add_attribute($atr);

            echo $div->get_html();


            $form = new \HTMLFormElement();
            $atr = new \HTMLAttribute("action", "/Account");
            $form->add_attribute($atr);
            $atr = new \HTMLAttribute("method", "POST");
            $form->add_attribute($atr);

            $input = new \HTMLInputElement();
            $atr = new \HTMLAttribute("type", "submit");
            $input->add_attribute($atr);
            $atr = new \HTMLAttribute("value", "change password");
            $input->add_attribute($atr);
            $atr = new \HTMLAttribute("name", "submit");
            $input->add_attribute($atr);
            $form->add_child($input);
            echo $form->get_html();

            //add how many times user solved quiz,avg score...
            //******************************

            $table = new \HTMLTableElement();
            $cell = new \HTMLCellElement("QuizName");
            $cell1 = new \HTMLCellElement("Attempts");
            $cell2 = new \HTMLCellElement("AvgScore");
            $atr = new \HTMLAttribute("style","padding: 20px;");
            $cell->add_attribute($atr);
            $cell1->add_attribute($atr);
            $cell2->add_attribute($atr);
            $redak = new \HTMLRowElement([
               $cell,$cell1,$cell2
            ]);
            $atr= new \HTMLAttribute("style","font-size:40px; ");
            $redak->add_attribute($atr);
            $table->add_row($redak);


            foreach ($this->data as $row) {
                $cell = new \HTMLCellElement($row["QuizName"]);
                $cell1 = new \HTMLCellElement($row["Attempts"]);
                $cell2 = new \HTMLCellElement($row["Score"] ." %");

                $row = new \HTMLRowElement([$cell,$cell1,$cell2]);
                $atr = new \HTMLAttribute("style","text-align:center; font-size:20px;");
                $row->add_attribute($atr);
                $table->add_row($row);

            }
            $atr = new \HTMLAttribute("style","display:flex; align-items:center; justify-content:center;");
            $table->add_attribute($atr);

            echo $table;



            //***********************
        }
        else {
            echo "<br>";
            $form = new \HTMLFormElement();
            $atr = new \HTMLAttribute("action","/Account");
            $form->add_attribute($atr);
            $atr = new \HTMLAttribute("method","POST");
            $form->add_attribute($atr);

            $in = new \HTMLInputElement();
            $atr = new \HTMLAttribute("placeholder","Old Password");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("type","password");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("name","oldPassword");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("maxlength","30");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("style","margin:2px;");
            $in->add_attribute($atr);
            $form->add_child($in);

            $in = new \HTMLInputElement();
            $atr = new \HTMLAttribute("placeholder","New Password");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("type","password");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("name","newPassword");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("maxlength","30");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("style","margin:2px;");
            $in->add_attribute($atr);
            $form->add_child($in);

            $in = new \HTMLInputElement();
            $atr = new \HTMLAttribute("placeholder","Repeat New Password");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("name","newRPassword");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("type","password");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("maxlength","30");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("style","margin:2px;");
            $in->add_attribute($atr);
            $form->add_child($in);

            $in = new \HTMLInputElement();
            $atr = new \HTMLAttribute("type","submit");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("name","changePass");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("value","change");
            $in->add_attribute($atr);
            $atr = new \HTMLAttribute("style","margin:2px;");
            $in->add_attribute($atr);
            $form->add_child($in);

            $atr = new \HTMLAttribute("style","display:flex; 
            flex-flow: column; align-items:flex-start;");
            $form->add_attribute($atr);

            echo $form->get_html();
        }
    }
}
<?php


namespace view;


class StatisticsView extends AbstractView
{

    private $data = [];

    public function __construct($data) {
        $this->data = $data;
    }

    public function generateHTML()
    {
        $MyTable = new \HTMLTableElement();
        $cell = new \HTMLCellElement("QuizName");
        $cell1 = new \HTMLCellElement("Min");
        $cell2 = new \HTMLCellElement("Max");
        $cell3 = new \HTMLCellElement("Avg");
        $cell4 = new \HTMLCellElement("Std");
        $atr = new \HTMLAttribute("style","padding: 30px;");
        $cell->add_attribute($atr);
        $cell1->add_attribute($atr);
        $cell2->add_attribute($atr);
        $cell3->add_attribute($atr);
        $cell4->add_attribute($atr);
        $redak = new \HTMLRowElement([
            $cell,$cell1,$cell2,$cell3,$cell4
        ]);
        $atr= new \HTMLAttribute("style","font-size:40px; ");
        $redak->add_attribute($atr);
        $MyTable->add_row($redak);

        $OtherTable = new \HTMLTableElement();
        $cell = new \HTMLCellElement("QuizName");
        $cell1 = new \HTMLCellElement("Min");
        $cell2 = new \HTMLCellElement("Max");
        $cell3 = new \HTMLCellElement("Avg");
        $cell4 = new \HTMLCellElement("Std");
        $atr = new \HTMLAttribute("style","padding: 30px; ");
        $cell->add_attribute($atr);
        $cell1->add_attribute($atr);
        $cell2->add_attribute($atr);
        $cell3->add_attribute($atr);
        $cell4->add_attribute($atr);
        $redak = new \HTMLRowElement([
            $cell,$cell1,$cell2,$cell3,$cell4
        ]);
        $atr= new \HTMLAttribute("style","font-size:40px; ");
        $redak->add_attribute($atr);
        $OtherTable->add_row($redak);

        session_start();
        foreach ($this->data as $row) {
            $cell = new \HTMLCellElement($row["name"]);
            $cell1 = new \HTMLCellElement($row["min"]);
            $cell2 = new \HTMLCellElement($row["max"]);
            $cell3 = new \HTMLCellElement($row["avg"]);
            $cell4 = new \HTMLCellElement($row["std"]);
            $tableRow = new \HTMLRowElement([
                $cell,$cell1,$cell2,$cell3,$cell4
            ]);
            $atr = new \HTMLAttribute("style","text-align:center; font-size:20px; ");
            $tableRow->add_attribute($atr);

            if($row["id"] == $_SESSION["userId"]) {
                $MyTable->add_row($tableRow);
            }else {
                $OtherTable->add_row($tableRow);
            }
        }

        $p = new \HTMLTextNode("Owned by me");
        $div = new \HTMLDivElement();
        $atr = new \HTMLAttribute("style","font-size:25px; margin-top:20px;");
        $div->add_attribute($atr);
        $div->add_child($p);

        echo $div->get_html();

        $atr = new \HTMLAttribute("style","border: 1px solid black; padding:10px;");
        $MyTable->add_attribute($atr);
        echo $MyTable;

        $p = new \HTMLTextNode("Owned by other");
        $div = new \HTMLDivElement();
        $atr = new \HTMLAttribute("style","font-size:25px; margin-top:20px;");
        $div->add_attribute($atr);
        $div->add_child($p);

        echo $div->get_html();
        $atr = new \HTMLAttribute("style","border: 1px solid black; padding:10px;");
        $OtherTable->add_attribute($atr);
        echo $OtherTable;

    }
}
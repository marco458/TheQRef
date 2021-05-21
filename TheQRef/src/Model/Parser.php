<?php


namespace Model;


class Parser
{
    public static function parse ($file): array {
        $questions = explode(';', $file);
        $map = [];
        foreach ($questions as $question) {
            $questionAndType = [];
            $answers = [];
            $correctAnswers = [];
            $type = 1;
            for($i = 0; $i < strlen($question); $i++) {
                if($question[$i] == "{") {
                    $type = $question[$i+1];
                    array_push($questionAndType,substr($question,0,$i));
                    array_push($questionAndType,$type);
                }
                if($question[$i] == ":" && $type != 3) {
                    $signStart = $i;
                    $signEnd = 0;
                    for($j = $i+1; $j < strlen($question); $j++) {
                        if($question[$j] == "=") {
                            $signEnd = $j;
                            break;
                        }
                    }
                    array_push($answers,explode(",",substr($question,$signStart+1,$signEnd-$signStart-1)));
                }
                if($question[$i] == ":" && $type == 3) {
                    $signStart = $i;
                    $signEnd = strlen($question);
                    array_push($correctAnswers,explode(",",substr($question,$signStart+1,$signEnd)));
                }

                if($question[$i] == "=") {
                    array_push($correctAnswers,explode(",",substr($question,$i+1,strlen($question))));
                }
            }
            $formatQuestion = [];
            $formatQuestion["questionAndType"] = $questionAndType;
            $formatQuestion["answers"] = $answers;
            $formatQuestion["correctAnswers"] = $correctAnswers;

            array_push($map,$formatQuestion);
        }
        return $map;
    }
}
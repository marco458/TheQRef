<?php


namespace controller;


use Model\Parser;
use Model\Quiz;
use Model\Score;
use Model\User;
use view\QuizView;
use view\SolvedQuizView;

class QuizController extends AbstractController
{

    protected function doJob()
    {
        $segments = explode('/', $_SERVER['REQUEST_URI']);
        $quizId = $segments[2];
        $quiz = new Quiz();
        $quizDataPom = $quiz->getQuizWithID($quizId);
        $quizData = $quizDataPom[0];

        $user = new User();
        $userData = $user->getInfo($quizData["UserId"]);

        if(!isset($_POST["submitQuiz"])) {
            $view = new QuizView($quizData, $userData);
            $view->generateHTML();
            return;
        }

        //let's validate quiz
        $userAnsweredCorrect = [];
        $questions = Parser::parse($quizData["QuizQuestions"]);
        $correctAnswers = [];
        $userAnswers = [];
        foreach ($questions as $question) {
            $type = $question["questionAndType"][1];
            if($type==1) {
                foreach ($question["correctAnswers"][0] as $x) {
                    array_push($correctAnswers, $x);
                }
            }
            if($type == 2) {
                $pom = [];
                foreach ($question["correctAnswers"][0] as $x) {
                   array_push($pom,$x);
                }
                array_push($correctAnswers, $pom);
            }
            if($type==3) {
                foreach ($question["correctAnswers"][0] as $x) {
                    array_push($correctAnswers, $x);
                }
            }
        }

        $correct = 0;
        $numberOfQ = 0;
        $answerIsArray = 0;
        $i = 1;
        $userAnsweredQuestion = 0;
        foreach ($questions as $question) {
            $br = 0;
            $type = $question["questionAndType"][1];
            $answers = [];
            foreach ($question["answers"][0] as $x) {
                array_push($answers,$x);
            }

            if($type == 1) {
                array_push($userAnswers,$_POST[$i]);
                if ($_POST[$i] == $correctAnswers[$numberOfQ]) {
                    $correct++;
                    array_push($userAnsweredCorrect,1);
                }else{array_push($userAnsweredCorrect,0);}
                if(isset($_POST[$i])) {
                    $br++;
                    if($br == 1) {
                        $userAnsweredQuestion++;
                    }
                }
                $i++;
            }


            if($type == 2) {

                $counter=0;
                $realArray = [];
                foreach ($correctAnswers as $ans) {
                    if (is_array($ans)) {
                        $counter++;
                    }
                    if (is_array($ans) && $counter > $answerIsArray) {
                        $answerIsArray++;
                        $realArray = $ans;
                        break;
                    }
                }

                $match = 0;
                $i1 = $i;
                foreach ($answers as $ans) {
                    if(isset($_POST[$i1])) {

                        $matchHapenned = false;
                        foreach ($realArray as $x) {
                            if ($_POST[$i1] == $x) {
                                $match++;
                                $matchHapenned = true;
                            }
                        }

                        if (!$matchHapenned) {
                            $match = 0;
                            break;
                        }

                    }
                    $i1++;
                }

                foreach ($answers as $ans) {
                    if(isset($_POST[$i])) {
                        $br++;
                        if($br == 1) {
                            $userAnsweredQuestion++;
                        }
                    }
                    array_push($userAnswers,$_POST[$i]);
                    $i++;
                }
                $realNumber = 0;
                foreach ($realArray as $x) {
                    $realNumber++;
                }

                if($match == $realNumber) {
                    $correct++;
                    array_push($userAnsweredCorrect,1);
                }else {array_push($userAnsweredCorrect,0);}
            }

            //dodaj za tip3
            if($type == 3) {
                if(($_POST[$i]) != "") {
                    $br++;
                    if($br == 1) {
                        $userAnsweredQuestion++;
                    }
                }
                array_push($userAnswers,$_POST[$i]);
                if(strtolower($_POST[$i]) == strtolower($correctAnswers[$numberOfQ])) {
                    $correct++;
                    array_push($userAnsweredCorrect,1);
                }else {array_push($userAnsweredCorrect,0);}
                $i++;
            }
            //dodaj za tip3

            $numberOfQ++;
        }
        $numberOfQ--;

        $Finalscore = 0;
        if($numberOfQ != 0) {
            $Finalscore = $correct / $numberOfQ * 100;
        }
        $score = new Score();
        $comments = $score->getComments($quizId);

        $scoreModel = new Score();
        session_start();
        //we will save only logged user
        if($_SESSION["userId"] >= 0) {
            $scoreModel->insert($quizId, $_SESSION["userId"], $Finalscore, "");
        }
        $view = new SolvedQuizView($quizData, $userData,$userAnsweredCorrect,$correctAnswers,$userAnswers,
            $correct,$userAnsweredQuestion,$Finalscore,$comments);
        $view->generateHTML();








    }
}
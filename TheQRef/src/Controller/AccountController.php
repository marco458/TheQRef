<?php


namespace controller;


use Model\Score;
use Model\User;
use view\AccountView;
use view\HeaderView;

class AccountController extends AbstractController
{

    protected function doJob()
    {
        $headerView = new HeaderView();
        $accView = new AccountView(true);
        if(isset($_POST["changePass"])){
            //all fields are filled?
            if($_POST["oldPassword"]== "" || $_POST["newPassword"]== ""
                || $_POST["newRPassword"]== "") {
                $headerView->generateHTML();
                echo "<br>" ."please fill in required fields!" ."<br>";
                $accView->generateHTML();
                return;
            }
            //is the oldPassword correct?
            session_start();
            if($_POST["oldPassword"] != $_SESSION["password"]) {
                $headerView->generateHTML();
                echo "<br>" ."that's not the password of your account!" ."<br>";
                $accView->generateHTML();
                return;
            }
            //passwords are same?
            if($_POST["newPassword"] != $_POST["newRPassword"]) {
                $headerView->generateHTML();
                echo "<br>" ."password and repeat password aren't same!" ."<br>";
                $accView->generateHTML();
                return;
            }
            //**************************
            if(strlen($_POST["newPassword"]) < 5) {
                $headerView->generateHTML();
                echo "<br>" ."password must have at least 5 characters!" ."<br>";
                $accView->generateHTML();
                return;
            }

            //*********************************
            //let's change password
            $user = new User();
            $newPassword = password_hash($_POST["newPassword"],PASSWORD_DEFAULT);
            $user->changePassword($_SESSION["userId"],$newPassword);
            $_SESSION["password"] = $_POST["newPassword"];
        }


        if(!isset($_POST["submit"])) {
            $headerView->generateHTML();
            //data
            session_start();
            $score = new Score();
            $data = $score->getDataForAccountView($_SESSION["userId"]);
            // echo $row["QuizName"] ." " .$row["Attempts"] ." " .$row["Score"]."<br>";
            $accView = new AccountView(false,$data);
            $accView->generateHTML();
            return;
        }

        $headerView->generateHTML();
        $accView->generateHTML();
    }
}
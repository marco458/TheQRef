<?php


namespace controller;

use Model\User;
use view\IndexView;
use view\RegisterView;

class RegisterController extends AbstractController {

    protected function doJob() {
        $cont = new RegisterView();
        if(!isset($_POST["submit"])) {
            $cont->generateHTML();
            return;
        }
        else {
            //all fields are filled?
            if( ($_POST["name"]) =="" || ($_POST["surname"]) == "" || ($_POST["date"]) == ""
                || ($_POST["email"]) == "" || ($_POST["password"]) == "" || ($_POST["repeatPassword"]) == "" ) {

                $cont = new RegisterView("please fill in required fields!");
                $cont->generateHTML($_POST["name"],$_POST["surname"],$_POST["date"]
                    ,$_POST["email"],$_POST["password"]);
                return;
            }
            //passwords are same?
            if($_POST["password"] != $_POST["repeatPassword"]) {
                $cont = new RegisterView("password and repeat password aren't same!");
                $cont->generateHTML($_POST["name"],$_POST["surname"],$_POST["date"]
                    ,$_POST["email"]);
                return;
            }

            //is email in valid form?
            $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $cont = new RegisterView("email is not valid");
                $cont->generateHTML($_POST["name"],$_POST["surname"],$_POST["date"]
                    ,"",$_POST["password"],$_POST["repeatPassword"]);
                return;
            }
            //user with that email already exists?
            $user = new User();
            if($user->userExists($_POST["email"])) {
                $cont = new RegisterView("This email address is already being used!");
                $cont->generateHTML($_POST["name"],$_POST["surname"],$_POST["date"]
                    ,"","","");
                return;
            }
            if(strlen($_POST["password"]) < 5) {
                $cont = new RegisterView("password must have at least 5 characters!");
                $cont->generateHTML($_POST["name"],$_POST["surname"],$_POST["date"]
                    ,$_POST["email"]);
                return;
            }

            //all fields are filled, passwords are same and email is valid
            //so let's save a new user

            $hashedAndSaltedPassword = password_hash($_POST["password"],PASSWORD_DEFAULT);

            $user = new User();
            $user->insert($_POST["name"],$_POST["surname"],$_POST["date"],
                $_POST["email"],$hashedAndSaltedPassword);

            header('Location:/');
        }

    }
}
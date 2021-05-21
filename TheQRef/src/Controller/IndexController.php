<?php

namespace controller;

use Model\User;
use view\HeaderView;
use view\IndexView;

class IndexController extends AbstractController
{

    public function __construct()
    {

    }

    protected function doJob()
    {
        session_start();
        session_unset();
        session_destroy();
        $view = new IndexView();
        if (!isset($_POST["submit"])) {
            $view->generateHTML();
            return;
        }
        if($_POST["username"] == "" || $_POST["password"] == "") {
            echo "wrong username/password";
            $view->generateHTML();
            return;
        }
        $user = new User();
        $userId =  $user->getIdFromEmail($_POST["username"]);
        $pass = $user->getPassword($userId);
        if(password_verify($_POST["password"],$pass)) {
            session_start();
            $_SESSION["userId"] = $userId;
        //    $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            header('Location:/Home');
        }else {
            echo "wrong username/password";
            $view->generateHTML();
            return;
        }


    }



}

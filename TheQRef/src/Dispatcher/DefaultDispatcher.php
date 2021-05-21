<?php

namespace Dispatcher;

use Router\DefaultRouter;

class DefaultDispatcher  {

    function __construct() {

    }


    public function dispatch() {

        $url = $_SERVER["REQUEST_URI"];

        $ruter = new DefaultRouter();

        if($ruter->match($url)) {

            $controllerString = $ruter->getController($url);
            if($controllerString != "AddController") {
                $argument = "";
                for($i = strlen($url); $i >= 0; $i--) {
                    if($url[$i] == "/") {
                        for($i1 = $i+1; $i1 < strlen($url); $i1++) {
                            $argument = $argument .$url[$i1];
                        }
                        break;
                    }
                }
            }
            $poziv = "\Controller\\"  .$controllerString;



            $controller = new $poziv($argument);
            $controller->doAction();
        }else {
            echo "ERROR";
        }
    }

}
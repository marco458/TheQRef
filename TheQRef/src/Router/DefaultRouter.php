<?php



namespace Router;

use Symfony\Component\Yaml\Yaml;
error_reporting(E_ERROR | E_PARSE);

class DefaultRouter  {

    private array $map = [];

    public function __construct() {
        $this->map = YAML::parse(file_get_contents("src/Router/routes.yaml"));
    }

    public function match($url):bool {
        if($url[0] == "/") {
            $pomUrl = "";
            for($i = 1; $i < strlen($url); $i++) {
                $pomUrl = $pomUrl . $url[$i];
            }
            $url = $pomUrl;
        }
        $matched = false;
        $povrat = false;
        foreach ($this->map as $key => $value) {
            $povrat = false;
            foreach ($value as $k => $v) {
                if($k == "url") {
                    $subject = $v;
                }
                if(is_array($v)) {
                    foreach ($v as $regex) {
                        $regularan = $regex;
                    }

                    $doslashDATA = "";
                    for($i = 0; $i < strlen($subject);$i++) {
                        $doslashDATA = $doslashDATA .$subject[$i];
                        if($subject[$i] == "/") {
                            break;
                        }
                    }

                    $urldoslash = "";
                    $urlnakonSlash = "";
                    for($i = 0; $i < strlen($url);$i++) {
                        $urldoslash = $urldoslash .$url[$i];
                        if($url[$i] == "/") {
                            for($i1= $i+1; $i1 < strlen($url);$i1++) {
                                $urlnakonSlash = $urlnakonSlash .$url[$i1];
                            }
                            break;
                        }
                    }
                 /*   echo "urldoslash =".$urldoslash ." doslahDATA =" .$doslashDATA ."<br>";
                   */
                    if($urldoslash != $doslashDATA) {
                        $povrat = false;
                        /*   echo "usli <br>"; */
                    }
                    else {
                        /*     echo "nakon=" .$nakonSlash ."<br>"; */
                        if (preg_match("/^" . $regex . "$/", $urlnakonSlash)) {
                            $povrat = true;
                        }
                    }
                }
                /* AKO NEMA REGULARNOG IZRAZA*/

                if($subject == $url) {
                    $povrat = true;
                }

                /* AKO NEMA REGULARNOG IZRAZA*/

            }
            if($povrat) {
                $matched = true;
                break;
            }
        }

        if($matched) {
            return true;
        }else {
            return false;
        }
    }

    public function getController($url) {
        $podaci = [];
        if($url[0] == "/") {
            $pomUrl = "";
            for($i = 1; $i < strlen($url); $i++) {
                $pomUrl = $pomUrl . $url[$i];
            }
            $url = $pomUrl;
        }
        $matched = false;
        $povrat = false;
        foreach ($this->map as $key => $value) {
            $povrat = false;
            foreach ($value as $k => $v) {
                if($k == "url") {
                    $subject = $v;
                }
                if(is_array($v)) {
                    foreach ($v as $regex) {
                        $regularan = $regex;
                    }

                    $doslashDATA = "";
                    for($i = 0; $i < strlen($subject);$i++) {
                        $doslashDATA = $doslashDATA .$subject[$i];
                        if($subject[$i] == "/") {
                            break;
                        }
                    }

                    $urldoslash = "";
                    $urlnakonSlash = "";
                    for($i = 0; $i < strlen($url);$i++) {
                        $urldoslash = $urldoslash .$url[$i];
                        if($url[$i] == "/") {
                            for($i1= $i+1; $i1 < strlen($url);$i1++) {
                                $urlnakonSlash = $urlnakonSlash .$url[$i1];
                            }
                            break;
                        }
                    }
                    /*   echo "urldoslash =".$urldoslash ." doslahDATA =" .$doslashDATA ."<br>";
                      */
                    if($urldoslash != $doslashDATA) {
                        $povrat = false;
                        /*   echo "usli <br>"; */
                    }
                    else {
                        /*     echo "nakon=" .$nakonSlash ."<br>"; */
                        if (preg_match("/^" . $regex . "$/", $urlnakonSlash)) {
                            $povrat = true;
                        }
                    }
                }
                /* AKO NEMA REGULARNOG IZRAZA*/

                if($subject == $url) {
                    $povrat = true;
                }

                /* AKO NEMA REGULARNOG IZRAZA*/

            }
            if($povrat) {
                $matched = true;
                $podaci = $value;
                break;
            }
        }



        if($matched) {
            foreach ($podaci as $kljuc => $vr) {
                if($kljuc == "controller") {
                    return $vr;
                }
            }
        }else {

        }

    }


}

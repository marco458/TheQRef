<?php


namespace controller;


class RetrieveImageController extends AbstractController {

    protected function doJob() {

        $apsolutePathToImage = "C:\Programi\\xampp\htdocs\TheQRef\src\Img/";
        $segments = explode('/', $_SERVER['REQUEST_URI']);
        $name= $segments[2] .".png";

        $apsolutePathToImage = $apsolutePathToImage .$name;

        $apsolutePathToImage = trim($apsolutePathToImage);


        $im =  imagecreatefrompng($apsolutePathToImage);

        ob_clean();
        header("Content-type: image/png");
        imagepng($im);
        imagedestroy($im);


    }
}
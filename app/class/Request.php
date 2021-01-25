<?php
namespace App\Dgclass;

class Request{
    public static function input($name){
        return $_REQUEST[$name];
    }
}


?>
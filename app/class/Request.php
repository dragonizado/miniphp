<?php
namespace App\Dgclass;

class Request{
    public function input($name){
        return $_REQUEST[$name];
    }
}


?>
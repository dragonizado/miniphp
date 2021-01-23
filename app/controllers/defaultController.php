<?php

class defaultController extends Controllers{
    public function __construct(){

    }

    public function index(){
        echo "Esto es el metodo index del controlador ".__CLASS__;
    }
}


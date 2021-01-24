<?php
namespace App\Controllers;

use App\Dgclass\Controllers;
use App\Dgclass\Request;

class defaultController extends Controllers{
    
    public function __construct(){

    }

    public function index(){
        $this->view('default');
    }
}


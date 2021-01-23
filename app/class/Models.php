<?php

class Models
{
    public $db;
    public function __construct(){
        $this->connectToDb();
    }

    public function connectToDb(){
        $dbParams = [];
        $this->db = new PDO("","","",$dbParams);
    }
}




?>
<?php
namespace App\Controllers;

use App\Dgclass\Controllers;
use App\Dgclass\Request;



class pruebasController extends Controllers{
    protected $users_model;
    protected $products_model;
    public function __construct(){
        $this->users_model = $this->loadModel("user");
        $this->products_model = $this->loadModel("product");
    }

    public function index(){
        // $productos = $this->products_model->findAll(); //Llamar todos los recursos de una entidad
        // $user_uno = $this->users_model->where("id","1")->get(); //Llamar todos los campos de un recurso especifico
        // $user_dos = $this->users_model->select(["username","email"])->where("id","2")->get(); //Seleccionar un campo especifico de una entidad


        // $users = $this->users_model;
        // $users->username = "prueba";
        // $users->password = "123456";
        // $users->email = "prueba@prueba.com";
        // if($users->save()){
        //     echo "Exito al guardar en la base de datos";
        // }else{
        //     echo "Ups lo siento no se pudo guardar en la base de datos :(";
        // }
    }
}


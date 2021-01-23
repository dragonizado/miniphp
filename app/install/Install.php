<?php

class Install
{
    public $dg_path;
    public function __construct(){
        $this->dg_path =  dirname(__DIR__)."/vendor/dg/";
       $this->install();
       exit();
    }

    public function install(){
        $mensajes = null;
        if(isset($_POST["frm_checkdb"])){
            $app_name = $_POST['app_name'];
            $db_host = $_POST['db_host'];
            $db_name = $_POST['db_name'];
            $db_username = $_POST['db_username'];
            $db_password = $_POST['db_password'];

            try {
                $this->checkDBConection($db_host,$db_name,$db_username,$db_password);
                $this->createConfigFile($db_host, $db_name,$db_username,$db_password,$app_name);
                header("location: /");
            } catch (Exception $th) {
                $mensajes = $th->getMessage();
            }
            
        }
        include dirname(__file__)."/views/index.php";
    }

    protected function checkDBConection($host,$db_name,$username,$password){
        $db_params = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];
        try {
            return new PDO("mysql:host=$host;dbname=$db_name;charset=utf8",$username,$password,$db_params);
        } catch (PDOException $th) {
            throw new Exception("Error al conectar con la db: " . $th->getMessage(), 1);
        }
    }

    protected function createConfigFile($db_host, $db_name,$db_username,$db_password,$app_name){
        $file_name =$this->cleanPath( dirname(__DIR__)."/config/config.php");

        if(!file_exists($file_name)){
            if($handler = fopen($file_name,"a")){
                $config_content = file_get_contents( $this->cleanPath($this->dg_path."templates/config/config.txt"));
                $config_content = sprintf($config_content,$app_name,$db_host,$db_name,$db_username,$db_password);
                fwrite($handler,$config_content);
                fclose($handler);
               return true;
            }
        }else{
            return true;
        }
        
    }


    protected function cleanPath($path){
        return str_replace("/",DIRECTORY_SEPARATOR,$path);
        // return $path;
    }
}



?>
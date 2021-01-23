<?php

class DgConsole{
    protected $app_path;
    protected $dg_path;
    public function __construct($c){
        $this->app_path = $this->cleanPath(ROOT."app/");
        $this->dg_path = $this->cleanPath($this->app_path."vendor/dg/");
        if(isset($c[2])){
            $this->command($c[1],$c[2]);
        }else{
            exit("Debe ingresar un segundo parametro");
        }
    }

    public function command($string,$param = null){
        switch ($string) {
            case 'make:controller':
                if(!is_null($param)){
                    $this->generateController($param);
                }else{
                    exit("No se ha definido el nombre del controlador");
                }
                break;
            
            default:
                $this->showConsoleHelp();
                break;
        }
    }

    public function generateController($name){
        $controller_path = $this->cleanPath($this->app_path."controllers/");
        $controller_name = $name."Controller";
        $file_name = $controller_path.$controller_name.".php";
        if(!file_exists($file_name )){
            if($handler = fopen($file_name,"a")){
                $controler_content = file_get_contents( $this->cleanPath($this->dg_path."templates/controllers/controllers.txt"));
                $controler_content = sprintf($controler_content,$controller_name);
                fwrite($handler,$controler_content);
                fclose($handler);
                exit("Se ha creado el controlador correctamente");
            }else{
                exit("Error al crear el controlador");
            }

        }else{
            echo "El controlador $name ya existe";
            exit();
        }
        
    }
    public function generateModel($name){

    }
    public function generateView($name){

    }

    private function generateViewHtmlFull(){
        $path = dirname(__FILE__)."../vendor/dgviews/templates/full.html";
        return file_get_contents($path); 
    }

    private function getViewHtmlTemplates(){
        $path = dirname(__FILE__)."../vendor/dgviews/templates/full.html";
        return file_get_contents($path);
    }

    private function cleanPath($path){
        return str_replace("/",DIRECTORY_SEPARATOR,$path);
        // return $path;
    }

    private function showConsoleHelp(){
        echo "Comandos disponibles".PHP_EOL;
        echo "".PHP_EOL;
        echo " make:controller   se utiliza para crear un controlador ".PHP_EOL;
        echo "".PHP_EOL;
        exit();
    }

}


?>
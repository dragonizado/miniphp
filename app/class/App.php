<?php
namespace App\Dgclass;

class App 
{
    protected $controller;
    protected $method;
    protected $url_params;

    private $controllers_path = APP."controllers".DIRECTORY_SEPARATOR;

    public function __construct(){
        $this->clearUrl();

        if(!is_null($this->controller)){
            $this->controller = $this->controller."Controller";
            $controller_path = $this->controllers_path.$this->controller.".php";
            if(file_exists($controller_path)){
                require_once $controller_path;
                $this->controller = new $this->controller();
                if(!is_null($this->method)){
                    if(method_exists($this->controller,$this->method)){
                        if (!empty($this->url_params)) {
                                call_user_func_array(array($this->controller, $this->method), $this->url_params);
                            } else {
                                $this->controller->{$this->method}();
                            }
                    }else{
                        $this->redirectToErrorPage();
                    }
                }else{
                    $this->controller->index();
                }
            }else{
                $this->redirectToErrorPage();
            }
        }else{
             $this->showDefaultController();
             $this->controller->index();
        }

    }

    private function showDefaultController(){
        if(file_exists($this->controllers_path."defaultController.php")){
            require $this->controllers_path."defaultController.php";
            $this->controller = new \App\Controllers\defaultController();
        }else{
            exit("UPS Lo sentimos el controlador por defecto no existe.");
        }
    }

    private function redirectToErrorPage(){
        if(file_exists($this->controllers_path."errorController.php")){
            header("location: /?r=error");
        }else{
            exit("Ups algo a ocurrido y no encontramos la pagina de error ni el recurso que estas solicitando.");
        }
    }

    private function clearUrl(){
        if(isset($_GET['r'])){
            $url = $_GET['r'];
            $url = explode("/",$url);
            $this->controller = isset($url[0])?$url[0]:null;
            $this->method = isset($url[1])?$url[1]:null;
            unset($url[0],$url[1]);
            $this->url_params = array_values($url);
        }
    }


}




?>
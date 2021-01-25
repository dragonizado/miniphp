<?php
/*
* Dragonizado 2021
*/

define('ROOT',dirname(__DIR__). DIRECTORY_SEPARATOR);
define('APP',ROOT."app".DIRECTORY_SEPARATOR);


if(file_exists(ROOT."vendor/autoload.php")){
    // define("LOADCLASICCLASS",false);
    require ROOT."vendor/autoload.php";
}

if(is_dir(APP."install")){
    if(!file_exists(APP."config/config.php")){
        require APP."install/Install.php";
        new Install();
    }else{
        exit("Por seguridad eliminar la carpeta install.");
    }

}

$config = require APP."config/config.php";
require APP. "config/defines.php";

new \App\Dgclass\App();

?>
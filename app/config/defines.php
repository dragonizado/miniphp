<?php 
/*
* Dragonizado 2021
*/
define("APPNAME",$config['app_name']);
define('_DEFAULTFOLDER_TEMPLATE_',$config['template']);
define("CONTROLLERS_FOLDER",$config['controllers_folder'].DIRECTORY_SEPARATOR);


//Se define un entorno (desarrollo o producción)
define('ENVIRONMENT', $config['enviroment']);
if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

//Se crea una constante para crear una url global que dependa del hosting y que sea dinamica
define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);


//Se declara la configuracion para la base de datos
define("DB_TYPE","mysql");
define("DB_HOST",$config['db_host']);
define("DB_NAME",$config['db_name']);
define("DB_USER",$config['db_username']);
define("DB_PASS",$config['db_password']);
define('DB_CHARSET', $config['db_encode']);

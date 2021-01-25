<?php
namespace App\Dgclass;


class Models
{
    public $db;
    public $models_path = APP."models".DIRECTORY_SEPARATOR;

    protected $sql = "";

    public function __construct(){
        $this->connectToDb();
    }

    public function connectToDb(){
        $dbParams = [\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION];
        try {
            $this->db = new \PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASS,$dbParams);
        } catch (\PDOException $th) {
            exit("Error al conectar con la base de datos: ". $th->getMessage());
        }
    }

    public function load($model_name){
        $file_name = $model_name.".php";
        if(file_exists($this->models_path.$file_name)){
            require_once $this->models_path.$file_name;
            $model_class = "App\\Models\\" . $model_name;
            return new $model_class();
        }else{
            throw new \Exception("Error al cargar el modelo", 1);
        }
    }

    protected function _select(){
        $this->sql .= "SELECT";
    }

    protected function _insertInto(){
        $this->sql .= "INSERT INTO ";
    }

    protected function _selectAll()
    {
        $this->sql .= "SELECT *";
    }

    protected function from()
    {
        $this->sql .= " FROM ";
    }

    public function select($columns){
        $this->_select();
        if(is_array($columns)){
            $this->sql .= " ";
            foreach ($columns as $key => $column) {
                if($key == array_search(end($columns), $columns)){
                    $this->sql .= "$column ";
                }else{
                    $this->sql .= "$column, ";
                }
            }
        }else{
             $this->sql .= " $columns ";
        }
        return $this;
    }

    public function where($column,$value,$condition = " = "){

        if($this->sql == ""){
            $this->_selectAll();
        }

        $this->from();

        $this->sql .= $this->tPlural($this->getdgclassname()) . " WHERE ";

        $this->sql .= $column;

        if($condition == " = "){
           $this->sql .=  $condition;
           $this->sql .=  $value;
        }else{
            $this->sql .= $value;
            $this->sql .= $condition;
        }

        $this->sql .= ";";
        return $this;
    }

    public function get(){
        $sql = $this->sql;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function save(){
        $props = $this->getModelPro();

        $this->_insertInto();
        $this->sql .= $this->tPlural($this->getdgclassname());
        
        $this->sql .= " ( ";
        foreach($props as $key => $values){
            if($values == end($props)){
                $this->sql .= $key;
            }else{
                $this->sql .= $key.", ";
            }
        }
        $this->sql .= " )";

        $this->sql .= " VALUES ";

        $this->sql .= "( ";
        foreach($props as $key => $values){
            if($values == end($props)){
                $this->sql .=  $values;
            }else{
                $this->sql .=  $values.", ";
            }
        }
        $this->sql .= " );";


        exit($this->sql);
    }

    public function findAll(){
        $table_name = $this->tPlural($this->getdgclassname());
        $sql = "SELECT * FROM $table_name;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    private function getdgclassname(){
        $class_name = explode("\\", get_called_class());
        return end($class_name);
    }

    private function tPlural($model_name){
        return strtolower($model_name)."s";
    }
}




?>
<?php 
require_once __DIR__ . "/../database/database.php";

class BaseModel{

    protected $pdo;
    protected $tabela;
    public function __construct(){
        $this->pdo = Database::conectar();
    }
}
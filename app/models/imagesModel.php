<?php 
require_once __DIR__ . "/baseModel.php";
class imagesModel extends BaseModel{

    public function __construct(){
        $this->tabela = 'imagens';
        parent::__construct();
        
    }
    
    /**
     * @param array $imagem
     * ['nome', 'nome original', 'caminho']
     * @return bool
     *
     */
    public function criar($imagem){
        $query = "INSERT INTO $this->tabela (nome, nome_original,caminho) values (:nome, :nome_original, :caminho)";

        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            ':nome' => $imagem['nome'],
            ':nome_original'=> $imagem['nome_original'],
            ':caminho' => $imagem['caminho']
        ]);
    }

    /**
     * Summary of BuscarTodas
     * @return array
     *      ['id','nome', 'nome original','data_envio' 'caminho']
     * 
     */
    public function BuscarTodas(){
        $query = "SELECT * FROM $this->tabela ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();

    }

}
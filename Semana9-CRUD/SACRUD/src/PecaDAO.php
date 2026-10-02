<?php
declare(strict_types=1);

//Camada de ACesso a Dados (DAO) para almoxarifado de peças
// esta Camada sera um Classe de Conexão usando POO (Programaçãk orientada ao Objeto)

final class PecaDAO {
    //atributos da classe
    private PDO $pdo;

    //métodos da classe
    //construtor -> é o método que permite criar objetos desta classe
    public function __construct(PDO $pdo) {
        //ao chamar o construtor estou atribuindo um valor  ao atributo declarado anteriormente
        $this->pdo = $pdo;
    }
    // para criar um obj da clase PecaDAO é necessário ja possuir uma conexão estabelecida com o banco de dados, conexão essa criada anteriormente na classe ConexaoBanco

    //criar os método do CRUD
    //READ -> listar todas as peças em ordem decrescente
    public function listarTodos(): array {
        $sql = "SELECT * FROM pecas_industriais ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//criar uma lista de produtos associando os valores ao nomes das colunas do banco de dados
    }

}

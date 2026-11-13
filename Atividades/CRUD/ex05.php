<?php

declare(strict_types=1);

require_once 'conexao.php';

class PecaDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function excluir(int $id): void
    {
        $stmt = $this->pdo->prepare('UPDATE pecas_industriais SET ativo = FALSE WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    public function listarTodos(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM pecas_industriais WHERE ativo = TRUE');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

$pdo = conectar();
$dao = new PecaDAO($pdo);
$dao->excluir(1);

$ativos = $dao->listarTodos();
$todosNoBanco = $pdo->query('SELECT * FROM pecas_industriais')->fetchAll();

echo "Ativos: " . count($ativos) . "\n";
echo "Total salvo no banco: " . count($todosNoBanco) . "\n";

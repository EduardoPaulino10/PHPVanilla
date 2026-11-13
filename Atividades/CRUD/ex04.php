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

    public function registrarMovimentacao(int $pecaId, int $quantidade, string $tipo): bool
    {
        $this->pdo->beginTransaction();

        $stmt = $this->pdo->prepare('SELECT quantidade FROM pecas_industriais WHERE id = :id');
        $stmt->execute([':id' => $pecaId]);
        $estoqueAtual = (int)$stmt->fetchColumn();

        if ($tipo === 'SAIDA') {
            $quantidade = -$quantidade;
        }

        if ($estoqueAtual + $quantidade < 0) {
            $this->pdo->rollBack();
            return false;
        }

        $upd = $this->pdo->prepare('UPDATE pecas_industriais SET quantidade = quantidade + :qtd WHERE id = :id');
        $upd->execute([':qtd' => $quantidade, ':id' => $pecaId]);
        $this->pdo->commit();
        return true;
    }
}

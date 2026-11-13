<?php

declare(strict_types=1);

require_once 'conexao.php';

function cadastrar(PDO $pdo): void
{
    $sku = readline('SKU: ');
    $nome = readline('Nome: ');

    $stmt = $pdo->prepare('INSERT INTO pecas_industriais (sku, nome) VALUES (:sku, :nome)');
    $stmt->execute([':sku' => $sku, ':nome' => $nome]);

    echo "Cadastrado!\n";
}

function listar(PDO $pdo): void
{
    $stmt = $pdo->prepare('SELECT * FROM pecas_industriais WHERE ativo = TRUE');
    $stmt->execute();

    foreach ($stmt->fetchAll() as $p) {
        echo "{$p['id']} - {$p['sku']} - {$p['nome']}\n";
    }
}

$pdo = conectar();

while (true) {
    echo "1: Cadastrar | 2: Listar | 3: Sair\n";
    $op = readline('Opcao: ');

    if ($op === '1') cadastrar($pdo);
    if ($op === '2') listar($pdo);
    if ($op === '3') break;
}

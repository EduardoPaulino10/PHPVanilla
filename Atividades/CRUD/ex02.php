<?php

declare(strict_types=1);

require_once 'conexao.php';

function buscarVulneravel(string $termo): void
{
    $pdo = conectar();
    $dados = $pdo->query("SELECT * FROM pecas_industriais WHERE nome = '{$termo}'")->fetchAll();
    echo "Vulneravel trouxe: " . count($dados) . " registros\n";
}

function buscarProtegido(string $termo): void
{
    $pdo = conectar();
    $stmt = $pdo->prepare("SELECT * FROM pecas_industriais WHERE nome = :termo");
    $stmt->execute([':termo' => $termo]);
    $dados = $stmt->fetchAll();
    echo "Protegido trouxe: " . count($dados) . " registros\n";
}

buscarVulneravel("' OR '1'='1");
buscarProtegido("' OR '1'='1");

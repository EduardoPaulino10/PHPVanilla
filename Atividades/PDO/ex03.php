<?php

declare(strict_types=1);

function carregarAmbiente(string $ambiente): array
{
    $dados = parse_ini_file('ambientes.ini', true);

    if (!isset($dados[$ambiente])) {
        throw new Exception("Ambiente nao encontrado.");
    }

    return $dados[$ambiente];
}

function conectar(string $ambiente): void
{
    $cfg = carregarAmbiente($ambiente);
    $dsn = "pgsql:host={$cfg['db_host']};port={$cfg['db_port']};dbname={$cfg['db_name']}";
    $pdo = new PDO($dsn, $cfg['db_user'], $cfg['db_pass']);

    echo "Conectado no banco: {$cfg['db_name']}\n";
}

conectar('development');

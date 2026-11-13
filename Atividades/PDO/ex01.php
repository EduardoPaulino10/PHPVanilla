<?php

declare(strict_types=1);

function testarConexao(): void
{
    try {
        $cfg = parse_ini_file('database.ini');
        $dsn = "pgsql:host={$cfg['db_host']};port={$cfg['db_port']};dbname={$cfg['db_name']}";
        $pdo = new PDO($dsn, $cfg['db_user'], $cfg['db_pass']);

        $versao = $pdo->query('SELECT version()')->fetchColumn();
        echo "Sucesso! Porta {$cfg['db_port']} acessivel.\n";
        echo "Versao: {$versao}\n";
    } catch (PDOException $erro) {
        echo "Erro: Nao foi possivel conectar ao banco.\n";
    }
}

testarConexao();

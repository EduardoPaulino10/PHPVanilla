<?php

declare(strict_types=1);

require_once 'ConexaoBanco.php';

function testarSemSingleton(): array
{
    $cfg = parse_ini_file('database.ini');
    $dsn = "pgsql:host={$cfg['db_host']};port={$cfg['db_port']};dbname={$cfg['db_name']}";

    $tempoInicio = microtime(true);
    $memoriaInicio = memory_get_usage();

    for ($i = 0; $i < 50; $i++) {
        $pdo = new PDO($dsn, $cfg['db_user'], $cfg['db_pass']);
    }

    $tempoTotal = round((microtime(true) - $tempoInicio) * 1000, 2);
    $memoriaTotal = round((memory_get_usage() - $memoriaInicio) / 1024, 2);

    return [$tempoTotal, $memoriaTotal];
}

function testarComSingleton(): array
{
    $tempoInicio = microtime(true);
    $memoriaInicio = memory_get_usage();

    for ($i = 0; $i < 50; $i++) {
        $pdo = ConexaoBanco::obterConexao('database.ini');
    }

    $tempoTotal = round((microtime(true) - $tempoInicio) * 1000, 2);
    $memoriaTotal = round((memory_get_usage() - $memoriaInicio) / 1024, 2);

    return [$tempoTotal, $memoriaTotal];
}

$sem = testarSemSingleton();
$com = testarComSingleton();

echo "<table border='1'>";
echo "<tr><th>Metodo</th><th>Tempo (ms)</th><th>Memoria (KB)</th></tr>";
echo "<tr><td>Sem Singleton</td><td>{$sem[0]}</td><td>{$sem[1]}</td></tr>";
echo "<tr><td>Com Singleton</td><td>{$com[0]}</td><td>{$com[1]}</td></tr>";
echo "</table>";

<?php

declare(strict_types=1);

require_once 'ConexaoBanco.php';

define('ARQUIVO_CONFIG', 'database.ini');

function testarSingleton(): void
{
    $conexao1 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);
    $conexao2 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);

    echo "ID 1: " . spl_object_id($conexao1) . "\n";
    echo "ID 2: " . spl_object_id($conexao2) . "\n";

    if ($conexao1 === $conexao2) {
        echo "Mesmo objeto na memoria!\n";
    } else {
        echo "Objetos diferentes!\n";
    }
}

testarSingleton();

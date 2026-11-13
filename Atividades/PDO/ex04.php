<?php

declare(strict_types=1);

function registrarLog(string $nivel, string $mensagem): void
{
    if ($nivel !== 'INFO' && $nivel !== 'WARNING' && $nivel !== 'ERROR') {
        return;
    }

    if (!is_dir('logs')) {
        mkdir('logs');
    }

    $dataHora = date('Y-m-d H:i:s');
    $linha = "[{$dataHora}] [{$nivel}] {$mensagem}\n";

    file_put_contents('logs/sistema.log', $linha, FILE_APPEND);
}

function testarSucesso(): void
{
    try {
        $cfg = parse_ini_file('database.ini');
        $dsn = "pgsql:host={$cfg['db_host']};port={$cfg['db_port']};dbname={$cfg['db_name']}";
        new PDO($dsn, $cfg['db_user'], $cfg['db_pass']);

        registrarLog('INFO', 'Conexao com o banco realizada com sucesso.');
    } catch (PDOException $erro) {
        registrarLog('ERROR', 'Falha na conexao valida.');
    }
}

function testarFalha(): void
{
    try {
        $dsn = "pgsql:host=127.0.0.1;port=5432;dbname=banco_inexistente";
        new PDO($dsn, 'usuario_errado', 'senha_errada');
    } catch (PDOException $erro) {
        registrarLog('ERROR', 'Falha ao tentar conectar no banco.');
    }
}

testarSucesso();
testarFalha();
echo "Testes finalizados! Abra o arquivo logs/sistema.log\n";

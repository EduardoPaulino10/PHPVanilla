<?php

declare(strict_types=1);

class ValorInvalidoException extends Exception {}

abstract class ContaBancaria
{
    private float $saldo = 0.0;

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new ValorInvalidoException('Valor inválido.');
        }
        $this->saldo += $valor;
    }
}

class ContaCorrente extends ContaBancaria {}

$conta = new ContaCorrente();
$bloqueios = 0;

try {
    $conta->saldo = 5000.0;
} catch (Error $erro) {
    echo "1. Bloqueado: Não pode alterar saldo privado.\n";
    $bloqueios++;
}

try {
    $teste = new ContaBancaria();
} catch (Error $erro) {
    echo "2. Bloqueado: Não pode criar objeto de classe abstrata.\n";
    $bloqueios++;
}

try {
    $conta->depositar(-10.0);
} catch (ValorInvalidoException $erro) {
    echo "3. Bloqueado: Não pode depositar valor negativo.\n";
    $bloqueios++;
}

echo "\nResultado: {$bloqueios} de 3 tentativas bloqueadas com sucesso.\n";

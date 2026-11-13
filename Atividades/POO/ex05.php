<?php

declare(strict_types=1);

class ContaBancaria
{
    protected float $saldo = 0.0;

    public function __construct(float $saldoInicial = 0.0)
    {
        $this->saldo = $saldoInicial;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception('Valor inválido.');
        }
        $this->saldo += $valor;
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0 || $valor > $this->saldo) {
            throw new Exception('Saldo insuficiente.');
        }
        $this->saldo -= $valor;
    }
}

class ContaInvestimento extends ContaBancaria
{
    public function getTaxaAdministracao(): float
    {
        if ($this->saldo >= 50000.0) {
            return 0.01;
        }
        return 0.02;
    }

    public function resgatar(float $valor, ContaBancaria $contaCorrente, int $dias): void
    {
        $this->sacar($valor);

        $imposto = 0.15;
        if ($dias < 30) {
            $imposto = 0.25;
        }

        $valorDescontado = $valor * $imposto;
        $valorFinal = $valor - $valorDescontado;

        $contaCorrente->depositar($valorFinal);
    }
}
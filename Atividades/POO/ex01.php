<?php

declare(strict_types=1);

class ContaBancaria
{
    protected string $titular;
    protected string $cpf;
    protected float $saldo;

    public function __construct(string $titular, string $cpf, float $saldo = 0.0)
    {
        $this->titular = $titular;
        $this->cpf = $cpf;
        $this->saldo = $saldo;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception('O valor deve ser maior que zero.');
        }

        $this->saldo += $valor;
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0 || $valor > $this->saldo) {
            throw new Exception('Saldo insuficiente ou valor inválido.');
        }

        $this->saldo -= $valor;
    }

    public function transferir(float $valor, ContaBancaria $destino): void
    {
        $this->sacar($valor);
        $destino->depositar($valor);
    }
}

class ContaSalario extends ContaBancaria
{
    public readonly string $cnpjEmpregador;
    private int $saquesRealizados = 0;

    public function __construct(string $titular, string $cpf, string $cnpjEmpregador, float $saldo = 0.0)
    {
        parent::__construct($titular, $cpf, $saldo);
        $this->cnpjEmpregador = $cnpjEmpregador;
    }

    public function depositar(float $valor): void
    {
        throw new Exception('Use o método depositarSalario com o CNPJ do empregador.');
    }

    public function depositarSalario(float $valor, string $cnpj): void
    {
        if ($cnpj !== $this->cnpjEmpregador) {
            throw new Exception('CNPJ do empregador inválido.');
        }

        parent::depositar($valor);
    }

    public function sacar(float $valor): void
    {
        $taxa = 0.0;

        if ($this->saquesRealizados >= 2) {
            $taxa = 4.00;
        }

        parent::sacar($valor + $taxa);
        $this->saquesRealizados++;
    }

    public function transferir(float $valor, ContaBancaria $destino): void
    {
        if ($destino->getCpf() !== $this->cpf) {
            throw new Exception('Só é permitido transferir para conta do mesmo CPF.');
        }

        parent::transferir($valor, $destino);
    }
}

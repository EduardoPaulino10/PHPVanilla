<?php

declare(strict_types=1);

class Transacao
{
    public string $tipo;
    public float $valor;
    public string $dataHora;
    public bool $sucesso;

    public function __construct(string $tipo, float $valor, bool $sucesso)
    {
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->sucesso = $sucesso;
        $this->dataHora = date('d/m/Y H:i:s');
    }
}

class ContaBancaria
{
    protected float $saldo = 0.0;
    protected array $historico = [];

    public function __construct(float $saldoInicial = 0.0)
    {
        $this->saldo = $saldoInicial;
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            $this->historico[] = new Transacao('Depósito', $valor, false);
            return;
        }
        $this->saldo += $valor;
        $this->historico[] = new Transacao('Depósito', $valor, true);
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0 || $valor > $this->saldo) {
            $this->historico[] = new Transacao('Saque', $valor, false);
            return;
        }
        $this->saldo -= $valor;
        $this->historico[] = new Transacao('Saque', $valor, true);
    }

    public function getExtrato(): array
    {
        return $this->historico;
    }

    public function mostrarExtrato(): void
    {
        echo "--- EXTRATO BANCÁRIO ---\n";
        foreach ($this->historico as $item) {
            $status = 'FALHA';
            if ($item->sucesso) {
                $status = 'OK';
            }
            echo "{$item->dataHora} | {$item->tipo} | R$ {$item->valor} | {$status}\n";
        }
        echo "SALDO FINAL: R$ {$this->saldo}\n";
    }
}

$conta = new ContaBancaria(100.0);
$conta->depositar(200.0);
$conta->sacar(50.0);
$conta->sacar(900.0);
$conta->mostrarExtrato();
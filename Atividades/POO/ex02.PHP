<?php

declare(strict_types=1);

class Titular
{
    public function __construct(public string $nome, public string $contato) {}
}

interface NotificadorInterface
{
    public function notificar(Titular $titular, string $mensagem): bool;
}

class NotificadorEmail implements NotificadorInterface
{
    public function notificar(Titular $titular, string $mensagem): bool
    {
        echo "[E-mail para {$titular->contato}]: {$mensagem}\n";
        return true;
    }
}

class NotificadorSMS implements NotificadorInterface
{
    public function notificar(Titular $titular, string $mensagem): bool
    {
        echo "[SMS para {$titular->contato}]: {$mensagem}\n";
        return true;
    }
}

class NotificadorWhatsApp implements NotificadorInterface
{
    public function notificar(Titular $titular, string $mensagem): bool
    {
        echo "[WhatsApp para {$titular->contato}]: {$mensagem}\n";
        return true;
    }
}

class ContaBancaria
{
    private array $notificadores = [];

    public function __construct(protected Titular $titular, protected float $saldo = 0.0) {}

    public function adicionarNotificador(NotificadorInterface $notificador): void
    {
        $this->notificadores[] = $notificador;
    }

    private function dispararNotificacoes(string $mensagem): void
    {
        foreach ($this->notificadores as $notificador) {
            $notificador->notificar($this->titular, $mensagem);
        }
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) throw new Exception('Valor inválido.');
        $this->saldo += $valor;
        $this->dispararNotificacoes("Depósito de R$ {$valor} realizado.");
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0 || $valor > $this->saldo) throw new Exception('Saldo insuficiente.');
        $this->saldo -= $valor;
        $this->dispararNotificacoes("Saque de R$ {$valor} realizado.");
    }
}

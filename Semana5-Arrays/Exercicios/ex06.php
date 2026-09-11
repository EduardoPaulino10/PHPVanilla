<?php
$extrato = [
    ["data" => "2026-09-01", "descricao" => "Salário", "tipo" => "Entrada", "valor" => 4000.00],
    ["data" => "2026-09-02", "descricao" => "Supermercado", "tipo" => "Saida", "valor" => 450.50],
    ["data" => "2026-09-05", "descricao" => "Pix João", "tipo" => "Entrada", "valor" => 200.00],
    ["data" => "2026-09-10", "descricao" => "Conta de Luz", "tipo" => "Saida", "valor" => 120.00],
    ["data" => "2026-09-12", "descricao" => "Cinema", "tipo" => "Saida", "valor" => 65.00]
];

// variaveis para somar os totais
$totalEntradas = 0;
$totalSaidas = 0;

// laco para ler as transacoes e somar com if tradicional
foreach ($extrato as $transacao) {
    if ($transacao['tipo'] == 'Entrada') {
        $totalEntradas = $totalEntradas + $transacao['valor'];
    } else {
        $totalSaidas = $totalSaidas + $transacao['valor'];
    }
}

// calcula o saldo atual
$saldoAtual = $totalEntradas - $totalSaidas;

// if tradicional para decidir a cor do saldo
if ($saldoAtual >= 0) {
    $corSaldo = "green";
} else {
    $corSaldo = "red";
}

// formatacao dos valores dos cartoes
$entradasFormatado = "R$ " . number_format($totalEntradas, 2, ",", ".");
$saidasFormatado = "R$ " . number_format($totalSaidas, 2, ",", ".");
$saldoFormatado = "R$ " . number_format($saldoAtual, 2, ",", ".");

// mostra os cartoes de resumo usando echo simples
echo "<div style='display: flex; gap: 15px; font-family: sans-serif; margin-bottom: 20px;'>";
    echo "<div style='border: 1px solid #ccc; padding: 15px;'>Entradas:<br><b style='color:green'>" . $entradasFormatado . "</b></div>";
    echo "<div style='border: 1px solid #ccc; padding: 15px;'>Saídas:<br><b style='color:red'>" . $saidasFormatado . "</b></div>";
    echo "<div style='border: 1px solid #ccc; padding: 15px;'>Saldo:<br><b style='color:" . $corSaldo . "'>" . $saldoFormatado . "</b></div>";
echo "</div>";

// mostra o topo da tabela completa
echo "<h3>Extrato Completo</h3>";
echo "<table border='1' cellpadding='8' style='border-collapse: collapse; font-family: sans-serif;'>";
echo "<tr><th>Data</th><th>Descrição</th><th>Tipo</th><th>Valor</th></tr>";

// laco para preencher a tabela do extrato
foreach ($extrato as $transacao) {
    $valorFormatado = "R$ " . number_format($transacao['valor'], 2, ",", ".");
    
    echo "<tr>";
    echo "<td>" . $transacao['data'] . "</td>";
    echo "<td>" . $transacao['descricao'] . "</td>";
    echo "<td>" . $transacao['tipo'] . "</td>";
    echo "<td>" . $valorFormatado . "</td>";
    echo "</tr>";
}
echo "</table>";

// filtro de gastos altos usando a regra da missao sênior
$gastosAltos = array_filter($extrato, fn($t) => $t['tipo'] == 'Saida' && $t['valor'] > 100);

// mostra o topo da tabela de gastos altos
echo "<h3>Atenção: Gastos Altos do Mês</h3>";
echo "<table border='1' cellpadding='8' style='border-collapse: collapse; font-family: sans-serif; background:#ffe6e6;'>";
echo "<tr><th>Data</th><th>Descrição</th><th>Valor</th></tr>";

// laco para preencher os gastos altos
foreach ($gastosAltos as $gasto) {
    $valorGastoFormatado = "R$ " . number_format($gasto['valor'], 2, ",", ".");
    
    echo "<tr>";
    echo "<td>" . $gasto['data'] . "</td>";
    echo "<td>" . $gasto['descricao'] . "</td>";
    echo "<td style='color:red; font-weight:bold;'>" . $valorGastoFormatado . "</td>";
    echo "</tr>";
}
echo "</table>";
?>

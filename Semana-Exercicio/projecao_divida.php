<?php

declare(strict_types=1);

// Dados do cliente
$cliente = "A";
$divida = 1000.00;

// Define a taxa de acordo com o cliente
$taxa = match ($cliente) {
    "A" => 0.01,
    "B" => 0.02,
    "C" => 0.03,
    default => 0.05
};

// Mostra os dados
echo "Cliente: $cliente<br>";
echo "Taxa: ";
echo $taxa * 100;
echo "%<br><br>";

// Faz a conta dos 12 meses
for ($mes = 1; $mes <= 12; $mes++) {

    // No mês 6 não tem juros
    if ($mes == 6) {
        echo "Mês 6 - Não será contado os juros<br>";
        continue;
    }

    // Calcula e adiciona os juros
    $juros = $divida * $taxa;
    $divida = $divida + $juros;

    echo "Mês $mes - Juros: $juros - Dívida: $divida<br>";
}
?>
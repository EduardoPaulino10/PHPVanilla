<?php

declare(strict_types=1);

// Suma o valor de cada produto (preço × quantidade) e retorna o total
function calcularCarrinho(array $produtos): float
{
    $total = 0;

    foreach ($produtos as $produto) {
        $total += $produto["preco"] * $produto["quantidade"]; // Multiplica preço pela quantidade
    }

    return $total; // Retorna o valor final do carrinho
}

// Lista de produtos para teste
$produtos = [
    ["nome" => "Caderno", "preco" => 25.00, "quantidade" => 2], // 50.00
    ["nome" => "Caneta",  "preco" => 3.50,  "quantidade" => 4]  // 14.00
];

// Execução doc codigo
$total = calcularCarrinho($produtos);

echo "Total: R$ " . number_format($total, 2, ",", ".");

?>
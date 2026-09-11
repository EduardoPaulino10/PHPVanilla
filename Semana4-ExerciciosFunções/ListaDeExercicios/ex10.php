<?php

declare(strict_types=1);

// Altera o estoque do produto diretamente (passagem por referência &$produto)
// Retorna true se a retirada for válida e false se a quantidade for inválida ou insuficiente
function retirarEstoque(array &$produto, int $quantidade): bool
{
    if ($quantidade <= 0 || $quantidade > $produto["estoque"]) {
        return false; // Quantidade inválida ou maior que o estoque
    }

    $produto["estoque"] -= $quantidade; // Subtrai do estoque

    return true; 
}

// Produto inicial
$produto = [
    "nome" => "Caderno",
    "estoque" => 10
];

// Retirada válida 
if (retirarEstoque($produto, 3)) {
    echo "Retirada realizada.<br>"; 
} else {
    echo "Não foi possível retirar.<br>";
}

//Mostrea o estoque atual
echo "Estoque atual: " . $produto["estoque"] . "<br>"; 

// Retirada inválida 
if (retirarEstoque($produto, 20)) {
    echo "Retirada realizada.";
} else {
    echo "Retirada recusada.";    
}
?>
<?php

declare(strict_types=1);

// Percorre a lista de clientes e retorna o array do cliente se o nome for igual, ou null se não achar
function buscarCliente(array $clientes, string $nome): ?array
{
    foreach ($clientes as $cliente) {
        if ($cliente["nome"] === $nome) {
            return $cliente; // Cliente encontrado
        }
    }

    return null; // Não encontrado após percorrer a lista
}

// Lista de clientes para busca
$clientes = [
    ["nome" => "Eduardo", "idade" => 18],
    ["nome" => "Mariana", "idade" => 20]
];

// Buscar cliente existente 
$cliente = buscarCliente($clientes, "Eduardo");

if ($cliente !== null) {
    echo "Cliente encontrado: " . $cliente["nome"] . "<br>"; 
} else {
    echo "Cliente não encontrado<br>";
}

$cliente = buscarCliente($clientes, "Carlos");

if ($cliente !== null) {
    echo "Cliente encontrado: " . $cliente["nome"];
} else {
    echo "Cliente não encontrado";                          
}
?>
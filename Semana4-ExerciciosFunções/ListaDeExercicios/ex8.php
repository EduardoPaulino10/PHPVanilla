<?php

declare(strict_types=1);

// Remove pontos e traço, deixando apenas os números
function limparCPF(string $cpf): string
{
    return str_replace([".", "-"], "", $cpf);
}

// Retorna true se tiver exatamente 11 dígitos numéricos
function cpfValido(string $cpf): bool
{
    return strlen($cpf) === 11 && is_numeric($cpf);
}

// Teste do código
$cpf = "123.456.789-00";

$cpfLimpo = limparCPF($cpf); // "12345678900"

// Exibição dos resultados
echo "CPF: $cpfLimpo<br>"; 

if (cpfValido($cpfLimpo)) {
    echo "CPF válido";   
} else {
    echo "CPF inválido";
}
?>
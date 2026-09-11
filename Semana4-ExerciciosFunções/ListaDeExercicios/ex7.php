<?php

declare(strict_types=1);

// Retorna a média somando todas as notas e dividindo pela quantidade
function calcularMedia(array $notas): float
{
    return array_sum($notas) / count($notas);
}

// Retorna "Aprovado" se a média for 7 ou mais, senão "Reprovado"
function verificarAprovacao(float $media): string
{
    if ($media >= 7) {
        return "Aprovado";
    } else {
        return "Reprovado";
    }
}

// Teste do código
$notas = [8, 7, 6, 9];

$media = calcularMedia($notas); // Média = 7.50

// Exibição dos resultados
echo "Média: " . number_format($media, 2) . "<br>"; // Média: 7.50
echo "Situação: " . verificarAprovacao($media) . "<br>"; // Situação: Aprovado
echo "Maior nota: " . max($notas) . "<br>"; // Maior nota: 9
echo "Menor nota: " . min($notas);         // Menor nota: 6
?>
<?php

declare(strict_types=1);

// Calcula o IMC
function calcularIMC(float $peso, float $altura): float
{
    return $peso / ($altura * $altura);
}

// 3 diferentes testes
$imc1 = calcularIMC(70, 1.75);
$imc2 = calcularIMC(80, 1.80);
$imc3 = calcularIMC(60, 1.65);

//Exibi os resultados
echo "IMC 1: " . number_format($imc1, 2) . "<br>";
echo "IMC 2: " . number_format($imc2, 2) . "<br>";
echo "IMC 3: " . number_format($imc3, 2);
?>
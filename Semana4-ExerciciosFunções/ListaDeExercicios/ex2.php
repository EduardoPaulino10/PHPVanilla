<?php

declare(strict_types=1);

// Classifica o IMC, separando os tipos de pesos
function classificarIMC(float $imc): string
{
    if ($imc < 18.5) {
        return "Abaixo do peso";
    } elseif ($imc < 25) {
        return "Peso normal";
    } elseif ($imc < 30) {
        return "Sobrepeso";
    } else {
        return "Obesidade";
    }
}

// Aqui ele faz o "teste" do código
echo classificarIMC(17.5) . "<br>";
echo classificarIMC(22.5) . "<br>";
echo classificarIMC(27.5) . "<br>";
echo classificarIMC(32);
?>
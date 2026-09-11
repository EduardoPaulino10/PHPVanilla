<?php

declare(strict_types=1);

$peso = 100.0; 
$altura = 1.70;
$IMC = $peso / ($altura * $altura);

if ($IMC < 18.5) {
    echo "Abaixo do Peso";
} elseif ($IMC >= 18.5 && $IMC <= 24.9) {
    echo "Peso Normal";
} elseif ($IMC >= 25 && $IMC <= 29.9) {
    echo "Sobrepeso";
} elseif ($IMC >= 30 && $IMC <= 34.9) {
    echo "Obesidade Grau I";
} elseif ($IMC >= 35 && $IMC <= 39.9) {
    echo "Obesidade Grau II";
} else {
    echo "Obesidade Grau III";
};
?>
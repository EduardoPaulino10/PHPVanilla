<?php

declare(strict_types=1);

$diaSemana = "Segunda";
$isEstudante = false;
$valorBase = 40.00;

$descontoDia = match ($diaSemana) {
    "Segunda", "Terça" => 0.8,
    "Quarta" => 0.5,
    "Quinta", "Sexta", "Sábado", "Domingo" => 1.0
};

$valorFinal = $valorBase * $descontoDia;

if ($isEstudante) {
    $valorFinal = $valorFinal * 0.5;
}

echo "O valor do ingresso para o dia " . $diaSemana . " é: R$ " . $valorFinal;

?>
<?php

declare(strict_types=1);

$valorCompra = 300.00;

$statusFrete = $valorCompra >= 250
    ? "Frete Grátis"
    : "Frete R$ 25,00";

echo $statusFrete;
?>
<?php

declare(strict_types=1);

// Aplica o desconto no preço original
function aplicarDesconto(float &$preco, float $porcentagem): void
{
    $preco = $preco - ($preco * $porcentagem / 100);
}

$preco = 200.00;
//Mostra antes de aplicar o desconto
echo "Antes: R$ " . number_format($preco, 2, ",", ".") . "<br>";

aplicarDesconto($preco, 15);
//Mostra o resultado apos o desconto ser aplicado
echo "Depois: R$ " . number_format($preco, 2, ",", ".");
?>

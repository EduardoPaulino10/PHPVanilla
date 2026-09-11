<?php
$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];
// aplica o desconto de 20% em cada preco do carrinho
$carrinhoBlackFriday = array_map(function($item) {
    $item['preco'] = $item['preco'] * 0.80;
    return $item;
}, $carrinho);

echo "<h3>Preços da Black Friday:</h3>";
// laço para mostrar os produtos com preco novo
foreach ($carrinhoBlackFriday as $item) {
    $precoFormatado = "R$ " . number_format($item['preco'], 2, ",", ".");
    echo "Produto: " . $item['produto'] . " - Novo Preço: " . $precoFormatado . "<br>";
}
?>
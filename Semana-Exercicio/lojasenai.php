<?php 
declare(strict_types=1); 
 
$produtos = [ 
1 => ["nome" => "Coxinha", "preco" => 6.00, "estoque" => 10], 
2 => ["nome" => "Suco", "preco" => 5.00, "estoque" => 8], 
3 => ["nome" => "Sanduíche", "preco" => 12.00, "estoque" => 5], 
4 => ["nome" => "Bolo", "preco" => 7.50, "estoque" => 6] 
]; 
 
$pedido = []; 
$opcao = 0; 

do { 
    echo "1 - Listar produto(s) <br>"; 
    echo "2 - Adicionar produto(s) ao pedido <br>"; 
    echo "3 - Exibir resumo do pedido <br>"; 
    echo "4 - Finalizar compra <br>"; 
    echo "0 - Sair sem finalizar o pedido <br>"; 
 
    $opcao++; 
 
    match($opcao) { 
        1 => print "Listando produto(s) <br>",
        2 => print "Adicionando produto(s) ao pedido <br>",
        3 => print "Exibindo resumo do pedido <br>",
        4 => print "Finalizando compra <br>",
        0 => print "Saindo sem finalizar o pedido <br>",
        default => print "Erro: Digite uma opção válida.<br>"
    }; 
 
} while ($opcao != 4 && $opcao != 0); 
 
foreach ($produtos as $codigo => $produto) {
    echo $codigo . " - ";
    echo $produto["nome"] . " | R$ ";
    echo $produto["preco"] . " | Estoque: ";
    echo $produto["estoque"] . "<br>";
}

?>
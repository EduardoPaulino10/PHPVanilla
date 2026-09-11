<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudo de Variáveis</title>
</head>
<body>
    <h1>Estudo de Variáveis</h1>
    <hr>
    <?php 

    //O que é variáveis?
    //Uma variável é um espaço na memória usado para armazenar dados. Ela possui um nome e um valor, que pode ser alterado durante a execução do programa.


    // Para criar variáveis em php bata usar o sinal de $
    // Variáveis em php são NÃO tipadas, NÃO precisa declarar o tipo (Texto, numeros, booleanas)
    // Ao atribuir valor para a variável a tipagem é automática
    $nome = "João"; // Criação da variavel nome com o valor textual "João"
    $idade = 25; // Criação da variável idade com o valor numérico 25
    $ativo = true; // Criação da variável ativo com o valor booleano true
    $salario = 1520.68; // Variavel numerica - decimal (float - double)
    $status = null; // Variavel null 
    //$endereço; // Variável Undefined, não é possivel declarar uma variavel sem atribuir um valor a ela, não existe Undefined em PHP

    // Dicas para Criação de Variáveis: 
    // Não incie o nome de uma variavel com numeros
    // Não utilize espaços em banco
    // Não utilize caracteres especiais, somente o underline
    // Crie variáveis con nomes que ajudrão a identificar melhor a mesma
    // Evite utilizar letras maiúsculas.
    
    // Exibir as variáveis na tela
    echo "Nome: $nome <br>";
    echo "Idade: $idade <br>";
    echo "Ativo: $ativo <br>";
    echo "Salário: $salario <br>";
    echo "Status: $status <br>";

    echo "<br><h3> Constantes </h3><br>";

    // O que é uma variável constante?
    // Uma constante é uma variável cujo valor não pode ser alterado após ser definido.


    // Constantes são representadas pela palvra "const" ou "define" seguidas do nome da constante
    //Exemplos de constantes
    const PI = 3.14; // Constante do Tipo Number (float)
    const EMPRESA = "Google"; // Constante do Tipo String
    define("SITE", "www.google.com"); //Declaração de Constante do tipo String usando "define"
    // Uma boa prática é utilizar letras maiúsculas para nomear constantes, para diferenciar de variáveis.

    // Exibir as constantes na tela
    echo "Valor de PI: " . PI . "<br>";
    echo "Nome da Empresa: " . EMPRESA . "<br>";
    echo "Site: " . SITE . "<br>";

    // Terntar alterar o valor de uma constante, isso irá gerar um erro de código, pois constantes não podem ser alteradas.
    // PI = 3.14159; // isso é um erro
    // redeclarar uma constante tamb´me irá gerar um erro
    // const SITE = "www.google.com"; // isso é um erro

    // Regra de Ouro: Sempre coloque a instrução "declare (strict_types=1);" no início do código PHP,
    // Isso blindará o seu sistema contra mistura acidentais de tipos de dados.
    

    // Utilização de Texto (Concatenação Vs Interpolação)
    
    // Exemplo de concatenação => Juntar duas ou mais strings utilzando o operador "."(ponto)
    echo "Olá " . $nome . ", Seja bem-vindo ao nosso site! <br>";

    // Exemplo de interpolação => Utilização de variáveis dentro de um texto, utilizando aspas duplas no texto
    echo "$nome, tem $idade anos e seu salário é de R$ $salario reais. <br>"; // Forma mais correta de misturar texto e variável

    ?>      

    
</body>
</html>
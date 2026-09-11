## 1. Conceito de função

### Uma função é uma parte do código que serve para fazer uma determinada tarefa.
### Duas vantagens são deixar o código mais organizado e evitar ficar repetindo código.

## 2. Princípio DRY

### Repetir o mesmo código várias vezes pode dar problema porque, se precisar mudar alguma coisa, vai ter que mudar em vários lugares. A função ajuda porque você escreve o código uma vez e pode usar ele várias vezes.

## 3. Parâmetros e retorno

### Parâmetros: São as informações que entram na função. No exemplo: o $preco e a $quantidade.
### Retorno: É o resultado que sai da função. No exemplo: o valor total da conta (preço vezes a quantidade).

## 4. Tipagem

### string → texto

### $nome → nome

### int → número inteiro

### $idade → idade

### bool → verdadeiro ou falso

### Cadastrar → nome da função

## 5. void e return

### Uma função que retorna string devolve um texto.
```php
function nome(): string {
    return "João";
}
```

### Já uma função void não devolve nenhum valor.
```php
function mensagem(): void {
    echo "Olá!";
}
```

## 6. Escopo

### Ela não consegue acessar $cliente porque a variável foi criada fora da função.

### Uma forma de resolver é usar global:
```php
$cliente = "Mariana";

function exibirCliente(): string {
    global $cliente;
    return $cliente;
}
```

### Outra forma é fazer o $cliente ficar como parâmetro. Essa é uma maneira melhor, porque fica mais organizado.

## 7. Referência

### O & faz a função mexer na variável original.

### Sem &, ela mexe só em uma cópia.

### Com &, ela consegue alterar o valor original.

## 8. Funções nativas

### strlen() → conta os caracteres de um texto e retorna int.

### strtoupper() → deixa o texto em maiúsculo e retorna string.

### count() → conta os itens de um array e retorna int.

### round() → arredonda um número e retorna o resultado.

### sqrt() → calcula a raiz quadrada e retorna um número.

## 9. Previsão de saída

### A saída vai ser:

### 90
### 100

### Isso acontece porque a função calcula 90% de 100, que dá 90. O valor $valor continua sendo 100 porque a função não muda ele.

## 10. Documentação do strlen()

### A sintaxe é:

### strlen(string $string): int

### Ela recebe um texto (string) e retorna um número inteiro (int) com a quantidade de caracteres/bytes.
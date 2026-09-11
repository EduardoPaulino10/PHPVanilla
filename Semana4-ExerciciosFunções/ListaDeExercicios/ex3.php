<?php

declare(strict_types=1);

// Verifica se a senha tem mais de 8 caracteres
function senhaForte(string $senha): bool
{
    return strlen($senha) > 8;
}

// Aqui vai fazer o teste com 2 senhas diferentes
$senha1 = "123456789";
$senha2 = "123456";

// Nessa parte, o codigo verifica se a senha 1 tem mais de 8 caracteres
if (senhaForte($senha1)) {
    echo "Senha 1: senha forte<br>";
} else {
    echo "Senha 1: senha fraca<br>";
}

// Nessa parte, o codigo verifica se a senha 2 tem mais de 8 caracteres
if (senhaForte($senha2)) {
    echo "Senha 2: senha forte";
} else {
    echo "Senha 2: senha fraca";
}
?>
<?php

// Formata o nome deixando só a primeira letra maiúscula
function formatarNome(string $nome): string
{
    $nome = trim($nome);       // Remove espaços do início/fim
    $nome = strtolower($nome); // Deixa tudo minúsculo
    return ucfirst($nome);     // Deixa a 1ª letra maiúscula
}

// Testes:
echo formatarNome("EDUARDO") . "<br>"; 
echo formatarNome("mArIa");           

?>
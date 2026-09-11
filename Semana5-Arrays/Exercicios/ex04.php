<?php
$filmes = [
    ["titulo" => "Matrix", "genero" => "Ficção", "classificacao_idade" => 16],
    ["titulo" => "Shrek", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Deadpool", "genero" => "Ação", "classificacao_idade" => 18],
    ["titulo" => "Procurando Nemo", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Vingadores", "genero" => "Ação", "classificacao_idade" => 12]
];
// filtra os filmes com idade menor ou igual a 12
$filmesInfantis = array_filter($filmes, fn($filme) => $filme['classificacao_idade'] <= 12);

echo "<h3>Catálogo Infantil:</h3>";

// laço para mostrar os filmes filtrados
foreach ($filmesInfantis as $filme) {
    echo "Filme: " . $filme['titulo'] . " | Gênero: " . $filme['genero'] . " | Classificação: Llivre (" . $filme['classificacao_idade'] . " anos)<br>";
}
?>
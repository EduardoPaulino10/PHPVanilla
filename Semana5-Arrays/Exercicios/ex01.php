<?php
// variaveis
$soma = 0;
$notas = [7.5, 8.0, 6.5, 9.0, 5.5];
// soma todas as notas
foreach ($notas as $nota) {
    $soma += $nota;
}
// calcula a média
$totalNotas = count($notas);
$media = $soma / $totalNotas;
// Saída Esperada
echo "A média final do aluno é " . number_format($media, 1) . "<br>";
// deixa o aprovado em verde e o reprovado em vermelho
if ($media >= 7) {
    echo "<span style='color: green; font-weight: bold;'>Aprovado</span>";
} else {
    echo "<span style='color: red; font-weight: bold;'>Reprovado</span>";
}
?>
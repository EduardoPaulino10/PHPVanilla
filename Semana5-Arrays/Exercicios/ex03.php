<?php
$funcionarios = [
    ["id" => 1, "nome" => "Ana Souza", "cargo" => "Dev Front-End", "salario" => 4500.00],
    ["id" => 2, "nome" => "Bruno Costa", "cargo" => "Dev Back-End", "salario" => 5200.00],
    ["id" => 3, "nome" => "Carla Dias", "cargo" => "Tech Lead", "salario" => 8900.00],
    ["id" => 4, "nome" => "Daniel Silva", "cargo" => "Estagiário", "salario" => 1500.00],
];
// variavel para somar o total
$totalFolha = 0;
// cria o topo da tabela
echo "<table border='1' cellpadding='8' style='border-collapse: collapse; font-family: sans-serif;'>";
echo "<tr><th>ID</th><th>Nome</th><th>Cargo</th><th>Salário</th></tr>";
// laço para ler cada funcionario
foreach ($funcionarios as $funcionario) {
    // soma o salario ao total
    $totalFolha += $funcionario['salario'];

    // formata o salario para real
    $salarioFormatado = "R$ " . number_format($funcionario['salario'], 2, ",", ".");

    // mostra a linha do funcionario
    echo "<tr>";
    echo "<td>" . $funcionario['id'] . "</td>";
    echo "<td>" . $funcionario['nome'] . "</td>";
    echo "<td>" . $funcionario['cargo'] . "</td>";
    echo "<td>" . $salarioFormatado . "</td>";
    echo "</tr>";
}
// formata o total geral
$totalFormatado = "R$ " . number_format($totalFolha, 2, ",", ".");
// mostra a linha final com o total
echo "<tr style='font-weight: bold;'>";
echo "<td colspan='3' align='right'>Total Gasto pela Empresa:</td>";
echo "<td>" . $totalFormatado . "</td>";
echo "</tr>";

echo "</table>";
?>

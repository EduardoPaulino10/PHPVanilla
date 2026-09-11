<?php

declare(strict_types=1);

$valorVeiculo = $_POST["valor_veiculo"] ?? "";
$valorEntrada = $_POST["valor_entrada"] ?? "";
$numeroParcelas = $_POST["numero_parcelas"] ?? "";

$erro = "";
$resultado = false;
$valorFinanciado = 0.0;
$totalJuros = 0.0;
$valorParcela = 0.0;

$parcelasPermitidas = [12, 24, 36, 48, 60];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $veiculo = (float) str_replace(',', '.', (string) $valorVeiculo);
    $entrada = (float) str_replace(',', '.', (string) $valorEntrada);
    $parcelas = (int) $numeroParcelas;

    if ($veiculo <= 0) {
        $erro = "Informe um valor válido para o veículo.";
    } elseif ($entrada < $veiculo * 0.20) {
        $erro = "A entrada deve ser de pelo menos 20% do valor do veículo.";
    } elseif ($entrada >= $veiculo) {
        $erro = "A entrada não pode ser maior ou igual ao valor do veículo.";
    } elseif (!in_array($parcelas, $parcelasPermitidas, true)) {
        $erro = "Número de parcelas inválido.";
    } else {
        $valorFinanciado = $veiculo - $entrada;
        $taxaJuros = 0.015;

        $valorParcela = $valorFinanciado * ($taxaJuros * pow(1 + $taxaJuros, $parcelas)) / (pow(1 + $taxaJuros, $parcelas) - 1);
        
        $valorTotal = $valorParcela * $parcelas;
        $totalJuros = $valorTotal - $valorFinanciado;

        $resultado = true;
    }
}

?>

<h1>Financiamento de Veículos</h1>

<form method="POST">

    <label>Valor do veículo:</label>
    <input
        type="number"
        name="valor_veiculo"
        step="0.01"
        value="<?= htmlspecialchars((string) $valorVeiculo) ?>"
    >

    <br><br>

    <label>Valor da entrada:</label>
    <input
        type="number"
        name="valor_entrada"
        step="0.01"
        value="<?= htmlspecialchars((string) $valorEntrada) ?>"
    >

    <br><br>

    <label>Número de parcelas:</label>
    <select name="numero_parcelas">
        <option value="">Selecione</option>
        <?php foreach ($parcelasPermitidas as $opcao): ?>
            <option
                value="<?= $opcao ?>"
                <?= (int) $numeroParcelas === $opcao ? "selected" : "" ?>
            >
                <?= $opcao ?> parcelas
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <button type="submit">Calcular</button>

</form>

<?php if ($erro !== ""): ?>
    <p style="color: red;">
        <?= htmlspecialchars($erro) ?>
    </p>
<?php elseif ($resultado): ?>
    <h2>Memória de Cálculo</h2>
    <p>Valor Financiado: R$ <?= number_format($valorFinanciado, 2, ",", ".") ?></p>
    <p>Total de Juros: R$ <?= number_format($totalJuros, 2, ",", ".") ?></p>
    <p>Valor de Cada Parcela: R$ <?= number_format($valorParcela, 2, ",", ".") ?></p>
<?php endif; ?>
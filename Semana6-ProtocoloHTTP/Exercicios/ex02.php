<?php

declare(strict_types=1);

function calcularIMC(float $peso, float $altura): float
{
    return $peso / ($altura * $altura);
}

function classificarIMC(float $imc): string
{
    if ($imc < 18.5) {
        return "Abaixo do peso";
    } elseif ($imc < 25) {
        return "Normal";
    } elseif ($imc < 30) {
        return "Sobrepeso";
    } else {
        return "Obesidade";
    }
}

$nome = $_POST["nome"] ?? "";
$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";

$erro = "";
$resultado = "";
$imc = 0.0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nomeLimpo = trim((string) $nome);
    $pesoNumero = (float) str_replace(',', '.', (string) $peso);
    $alturaNumero = (float) str_replace(',', '.', (string) $altura);

    if (empty($nomeLimpo)) {
        $erro = "Por favor, informe o seu nome.";
    } elseif ($pesoNumero < 20 || $pesoNumero > 300) {
        $erro = "O peso deve estar entre 20 e 300 kg.";
    } elseif ($alturaNumero < 0.5 || $alturaNumero > 2.5) {
        $erro = "A altura deve estar entre 0.5 e 2.5 metros.";
    } else {
        $imc = calcularIMC($pesoNumero, $alturaNumero);
        $resultado = classificarIMC($imc);
    }
}

?>

<h1>Calculadora de IMC</h1>

<form method="POST">

    <label>Nome:</label>
    <input
        type="text"
        name="nome"
        value="<?= htmlspecialchars((string) $nome) ?>"
    >

    <br><br>

    <label>Peso (kg):</label>
    <input
        type="number"
        name="peso"
        step="0.1"
        value="<?= htmlspecialchars((string) $peso) ?>"
    >

    <br><br>

    <label>Altura (m):</label>
    <input
        type="number"
        name="altura"
        step="0.01"
        value="<?= htmlspecialchars((string) $altura) ?>"
    >

    <br><br>

    <button type="submit">Calcular</button>

</form>

<?php if ($erro !== ""): ?>

    <p style="color: red;">
        <?= htmlspecialchars($erro) ?>
    </p>

<?php elseif ($resultado !== ""): ?>

    <h2>Resultado</h2>

    <p>
        Nome: <?= htmlspecialchars((string) $nome) ?>
    </p>

    <p>
        IMC: <?= number_format($imc, 2, ",", ".") ?>
    </p>

    <?php if ($resultado === "Normal"): ?>

        <p style="color: green;">
            Classificação: <?= htmlspecialchars($resultado) ?>
        </p>

    <?php elseif ($resultado === "Sobrepeso"): ?>

        <p style="color: #d6a600;">
            Classificação: <?= htmlspecialchars($resultado) ?>
        </p>

    <?php elseif ($resultado === "Obesidade"): ?>

        <p style="color: red;">
            Classificação: <?= htmlspecialchars($resultado) ?>
        </p>

    <?php else: ?>

        <p style="color: orange;">
            Classificação: <?= htmlspecialchars($resultado) ?>
        </p>

    <?php endif; ?>

<?php endif; ?>
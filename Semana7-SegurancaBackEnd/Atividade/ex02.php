<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$nome = '';
$link = '';
$erro = '';
$linkValido = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $link = trim($_POST['link'] ?? '');

    if ($nome === '') {
        $erro = 'Digite seu nome.';
    } elseif (!filter_var($link, FILTER_VALIDATE_URL)) {
        $erro = 'Digite uma URL válida.';
    } elseif (
        !str_starts_with($link, 'http://') &&
        !str_starts_with($link, 'https://')
    ) {
        $erro = 'Use somente http:// ou https://.';
    } else {
        $linkValido = $link;
    }
}
?>

<h1>Validador de Links</h1>

<form method="POST">

    <label>Nome:</label>
    <input type="text" name="nome" value="<?= e($nome) ?>">

    <br><br>

    <label>Link:</label>
    <input type="text" name="link" value="<?= e($link) ?>">

    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<?php if ($erro !== ''): ?>

    <p><?= e($erro) ?></p>

<?php endif; ?>

<?php if ($linkValido !== ''): ?>

    <p>Olá, <?= e($nome) ?>!</p>

    <a href="<?= e($linkValido) ?>" target="_blank">
        Visitar Portfólio
    </a>

<?php endif; ?>
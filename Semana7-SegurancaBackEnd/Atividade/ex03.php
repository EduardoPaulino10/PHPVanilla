<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$busca = $_GET['q'] ?? '';

?>

<h1>Busca de Produtos</h1>

<form method="GET">

    <label>Produto:</label>

    <input
        type="text"
        name="q"
        value="<?= e($busca) ?>"
    >

    <button type="submit">Buscar</button>

</form>

<?php if ($busca !== ''): ?>

    <p>Você buscou por: <?= e($busca) ?></p>

<?php endif; ?>
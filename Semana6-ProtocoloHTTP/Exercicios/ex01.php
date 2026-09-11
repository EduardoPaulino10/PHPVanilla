<?php

declare(strict_types=1);

$produtos = [
    [
        "nome" => "Notebook",
        "categoria" => "Informática",
        "preco" => 3500
    ],
    [
        "nome" => "Mouse",
        "categoria" => "Acessórios",
        "preco" => 80
    ],
    [
        "nome" => "Teclado",
        "categoria" => "Acessórios",
        "preco" => 150
    ],
    [
        "nome" => "Monitor",
        "categoria" => "Informática",
        "preco" => 900
    ],
    [
        "nome" => "Celular",
        "categoria" => "Smartphone",
        "preco" => 2200
    ],
    [
        "nome" => "Fone",
        "categoria" => "Acessórios",
        "preco" => 200
    ]
];

$nome = $_GET["nome"] ?? "";
$precoMaximo = $_GET["preco_maximo"] ?? "";

$produtosFiltrados = array_filter($produtos, function ($produto) use ($nome, $precoMaximo) {

    $nomeCorresponde = $nome === "" ||
        stripos($produto["nome"], $nome) !== false;

    $precoCorresponde = $precoMaximo === "" ||
        $produto["preco"] <= (float) $precoMaximo;

    return $nomeCorresponde && $precoCorresponde;
});

?>

<h1>Buscador de Produtos</h1>

<form method="GET">

    <label>Nome do produto:</label>
    <input
        type="text"
        name="nome"
        value="<?= htmlspecialchars($nome) ?>"
    >

    <br><br>

    <label>Preço máximo:</label>
    <input
        type="number"
        name="preco_maximo"
        step="0.01"
        value="<?= htmlspecialchars($precoMaximo) ?>"
    >

    <br><br>

    <button type="submit">Buscar</button>

</form>

<hr>

<?php foreach ($produtosFiltrados as $produto): ?>

    <h3><?= htmlspecialchars($produto["nome"]) ?></h3>

    <p>
        Categoria:
        <?= htmlspecialchars($produto["categoria"]) ?>
    </p>

    <p>
        Preço:
        R$ <?= number_format($produto["preco"], 2, ",", ".") ?>
    </p>

    <hr>

<?php endforeach; ?>
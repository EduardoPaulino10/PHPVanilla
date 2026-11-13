<?php

declare(strict_types=1);

require_once 'conexao.php';

function buscarPagina(PDO $pdo, int $pagina): array
{
    $offset = ($pagina - 1) * 5;
    $stmt = $pdo->prepare('SELECT * FROM pecas_industriais WHERE ativo = TRUE LIMIT :limite OFFSET :offset');
    $stmt->bindValue(':limite', 5, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

$pdo = conectar();
$pagina = (int)($_GET['p'] ?? 1);
$lista = buscarPagina($pdo, $pagina);

foreach ($lista as $item) {
    $nomeSeguro = htmlspecialchars($item['nome']);
    echo "<p>{$item['id']} - {$nomeSeguro}</p>";
}

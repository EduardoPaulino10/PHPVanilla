<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$mensagens = [
    [
        'nome' => 'Eduardo',
        'mensagem' => 'Olá! Este é um recado.'
    ],
    [
        'nome' => 'João',
        'mensagem' => 'Bom dia!'
    ]
];

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (strlen($nome) < 3) {
        $erro = 'O nome deve ter pelo menos 3 caracteres.';
    } elseif (strlen($mensagem) < 5) {
        $erro = 'A mensagem deve ter pelo menos 5 caracteres.';
    } else {
        $mensagens[] = [
            'nome' => $nome,
            'mensagem' => $mensagem
        ];
    }
}
?>

<h1>Mural de Recados</h1>

<?php if ($erro !== ''): ?>
    <p><?= e($erro) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Nome:</label>
    <input type="text" name="nome">

    <br><br>

    <label>Mensagem:</label>
    <textarea name="mensagem"></textarea>

    <br><br>

    <button type="submit">Enviar</button>
</form>

<hr>

<h2>Recados</h2>

<?php foreach ($mensagens as $item): ?>

    <h3><?= e($item['nome']) ?></h3>

    <p><?= nl2br(e($item['mensagem'])) ?></p>

    <hr>

<?php endforeach; ?>
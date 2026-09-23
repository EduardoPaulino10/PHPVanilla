<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function carregarMensagens(string $arquivo): array
{
    if (!file_exists($arquivo)) {
        return [];
    }

    $dados = json_decode(file_get_contents($arquivo), true);

    return is_array($dados) ? $dados : [];
}

function salvarMensagens(string $arquivo, array $mensagens): void
{
    $json = json_encode(
        $mensagens,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    file_put_contents($arquivo, $json);
}

$arquivo = 'chat.json';
$mensagens = carregarMensagens($arquivo);
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($mensagem === '') {
        $erro = 'Digite uma mensagem.';
    } elseif (mb_strlen($mensagem) > 250) {
        $erro = 'A mensagem não pode ter mais de 250 caracteres.';
    } else {
        $mensagens[] = $mensagem;
        salvarMensagens($arquivo, $mensagens);
    }
}

?>

<h1>Chat da Operação</h1>

<?php if ($erro !== ''): ?>

    <p><?= e($erro) ?></p>

<?php endif; ?>

<form method="POST">

    <label>Mensagem:</label>

    <br>

    <textarea name="mensagem"></textarea>

    <br><br>

    <button type="submit">Enviar</button>

</form>

<hr>

<h2>Mensagens</h2>

<?php foreach ($mensagens as $mensagem): ?>

    <p><?= nl2br(e($mensagem)) ?></p>

    <hr>

<?php endforeach; ?>
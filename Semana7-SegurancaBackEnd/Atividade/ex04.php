<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function sanitizarTexto(string $dado): string
{
    return strip_tags(trim($dado));
}

function validarColaborador(array $dados): array
{
    $erros = [];

    if ($dados['nome'] === '') {
        $erros[] = 'Nome obrigatório.';
    }

    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'E-mail inválido.';
    }

    if (filter_var($dados['matricula'], FILTER_VALIDATE_INT) === false) {
        $erros[] = 'Matrícula inválida.';
    }

    if (filter_var($dados['salario'], FILTER_VALIDATE_FLOAT) === false) {
        $erros[] = 'Salário inválido.';
    }

    return $erros;
}

$erros = [];
$colaborador = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $colaborador = [
        'nome' => sanitizarTexto($_POST['nome'] ?? ''),
        'email' => sanitizarTexto($_POST['email'] ?? ''),
        'matricula' => $_POST['matricula'] ?? '',
        'salario' => $_POST['salario'] ?? ''
    ];

    $erros = validarColaborador($colaborador);
}

?>

<h1>Cadastro de Colaborador</h1>

<form method="POST">

    <label>Nome:</label>
    <input type="text" name="nome">

    <br><br>

    <label>E-mail:</label>
    <input type="text" name="email">

    <br><br>

    <label>Matrícula:</label>
    <input type="text" name="matricula">

    <br><br>

    <label>Salário:</label>
    <input type="text" name="salario">

    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<?php if (count($erros) > 0): ?>

    <h2>Erros:</h2>

    <?php foreach ($erros as $erro): ?>

        <p><?= e($erro) ?></p>

    <?php endforeach; ?>

<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>

    <h2>Colaborador cadastrado!</h2>

    <p>Nome: <?= e($colaborador['nome']) ?></p>
    <p>E-mail: <?= e($colaborador['email']) ?></p>
    <p>Matrícula: <?= e($colaborador['matricula']) ?></p>
    <p>Salário: <?= e($colaborador['salario']) ?></p>

<?php endif; ?>
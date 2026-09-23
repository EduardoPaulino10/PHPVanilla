<?php
declare(strict_types=1);

// Dados mockados (8 cotações abertas fictícias)
$cotacoesAbertas = [
    [
        'id' => 1,
        'fornecedor' => 'Eletro Parts Ltda',
        'email' => 'contato@eletroparts.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'Bobinas de cobre 2mm - 100kg',
        'valor' => 4500.00,
        'prazo' => 7,
        'condicao' => '30 dias',
        'data_abertura' => '2026-09-10'
    ],
    [
        'id' => 2,
        'fornecedor' => 'Peças Mecânicas do Brasil',
        'email' => 'vendas@pecasmec.com.br',
        'categoria' => 'Mecânica',
        'descricao' => 'Rolamentos de esferas NSK 6204',
        'valor' => 1250.50,
        'prazo' => 5,
        'condicao' => 'À Vista',
        'data_abertura' => '2026-09-12'
    ],
    [
        'id' => 3,
        'fornecedor' => 'Supply Express',
        'email' => 'compras@supplyexpress.com.br',
        'categoria' => 'Consumíveis',
        'descricao' => 'Óleo hidráulico ISO 46 - 200L',
        'valor' => 2100.00,
        'prazo' => 3,
        'condicao' => '60 dias',
        'data_abertura' => '2026-09-15'
    ],
    [
        'id' => 4,
        'fornecedor' => 'Serviços Técnicos SENAI',
        'email' => 'servicos@senaigeral.com.br',
        'categoria' => 'Serviços',
        'descricao' => 'Manutenção preventiva - 40h',
        'valor' => 3200.00,
        'prazo' => 1,
        'condicao' => '30 dias',
        'data_abertura' => '2026-09-14'
    ],
    [
        'id' => 5,
        'fornecedor' => 'Eletrônicos Avançados SA',
        'email' => 'vendas@eletravanc.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'Transformador 10kVA 220/110',
        'valor' => 8750.00,
        'prazo' => 15,
        'condicao' => '90 dias',
        'data_abertura' => '2026-09-11'
    ],
    [
        'id' => 6,
        'fornecedor' => 'Plásticos Industriais',
        'email' => 'venda@plasticosindustriais.com.br',
        'categoria' => 'Consumíveis',
        'descricao' => 'Tubos PVC 75mm - 50 metros',
        'valor' => 650.00,
        'prazo' => 2,
        'condicao' => 'À Vista',
        'data_abertura' => '2026-09-13'
    ],
    [
        'id' => 7,
        'fornecedor' => 'Automação Industrial Plus',
        'email' => 'suporte@autoplus.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'CLP Siemens S7-1200',
        'valor' => 15800.00,
        'prazo' => 21,
        'condicao' => '60 dias',
        'data_abertura' => '2026-09-09'
    ],
    [
        'id' => 8,
        'fornecedor' => 'Consultoria Técnica Premium',
        'email' => 'info@consultoriatech.com.br',
        'categoria' => 'Serviços',
        'descricao' => 'Auditoria de processos - 3 dias',
        'valor' => 5600.00,
        'prazo' => 5,
        'condicao' => '30 dias',
        'data_abertura' => '2026-09-08'
    ]
];

// Constantes
const CATEGORIAS_PERMITIDAS = ['Eletrônicos', 'Mecânica', 'Consumíveis', 'Serviços'];
const CONDICOES_PAGAMENTO   = ['À Vista', '30 dias', '60 dias', '90 dias'];

// Bônus: carrega da persistência em JSON, se existir
if (file_exists('cotacoes.json')) {
    $dadosSalvos = json_decode((string)file_get_contents('cotacoes.json'), true);
    if (is_array($dadosSalvos) && $dadosSalvos !== []) {
        $cotacoesAbertas = $dadosSalvos;
    }
}

/** Aceita "R$ 1.234,56", "1234,56" ou "1234.56" e devolve float (ou null). */
function normalizarValor(string $v): ?float {
    $v = trim(str_ireplace(['R$', ' '], '', $v));
    if ($v === '') return null;
    if (str_contains($v, ',')) $v = str_replace(',', '.', str_replace('.', '', $v)); // remove milhar "." antes de trocar "," por "."
    $r = filter_var($v, FILTER_VALIDATE_FLOAT);
    return $r === false ? null : (float)$r;
}

/**
 * Valida uma nova cotação de fornecedor
 * @param array $dados Os dados do formulário
 * @return array Erros encontrados (vazio se tudo OK)
 */
function validarCotacao(array $dados): array {
    $erros = [];

    // Validar nome do fornecedor (mínimo 5 caracteres)
    if (strlen(trim($dados['nome_fornecedor'] ?? '')) < 5) {
        $erros['nome_fornecedor'] = 'O nome do fornecedor deve ter no mínimo 5 caracteres.';
    }

    // Validar e-mail
    if (!filter_var($dados['email_fornecedor'] ?? '', FILTER_VALIDATE_EMAIL)) {
        $erros['email_fornecedor'] = 'Informe um e-mail corporativo válido.';
    }

    // Validar categoria
    if (!in_array($dados['categoria_produto'] ?? '', CATEGORIAS_PERMITIDAS, true)) {
        $erros['categoria_produto'] = 'Selecione uma categoria permitida.';
    }

    // Validar descrição (mínimo 10 caracteres)
    if (strlen(trim($dados['descricao_item'] ?? '')) < 10) {
        $erros['descricao_item'] = 'A descrição deve ter no mínimo 10 caracteres.';
    }

    // Validar valor (número positivo, aceitando "R$" e separadores brasileiros)
    $valor = normalizarValor((string)($dados['valor_cotacao'] ?? ''));
    if ($valor === null || $valor <= 0) {
        $erros['valor_cotacao'] = 'Informe um valor positivo em R$.';
    }

    // Validar prazo (1 a 60 dias)
    $prazo = filter_var($dados['prazo_entrega_dias'] ?? '', FILTER_VALIDATE_INT);
    if ($prazo === false || $prazo < 1 || $prazo > 60) {
        $erros['prazo_entrega_dias'] = 'O prazo deve estar entre 1 e 60 dias.';
    }

    // Validar condição de pagamento
    if (!in_array($dados['condicoes_pagamento'] ?? '', CONDICOES_PAGAMENTO, true)) {
        $erros['condicoes_pagamento'] = 'Selecione uma condição de pagamento válida.';
    }

    return $erros;
}

/**
 * Filtra cotações abertas por fornecedor e/ou valor máximo
 * @param array $cotacoes Array de todas as cotações
 * @param string $fornecedor Nome parcial do fornecedor
 * @param float|null $valorMaximo Valor máximo permitido
 * @return array Cotações filtradas
 */
function filtrarCotacoes(array $cotacoes, string $fornecedor = '', ?float $valorMaximo = null): array {
    return array_filter($cotacoes, function ($cotacao) use ($fornecedor, $valorMaximo) {
        // Filtro por fornecedor (case-insensitive)
        if ($fornecedor !== '' && stripos($cotacao['fornecedor'] ?? '', $fornecedor) === false) {
            return false;
        }

        // Filtro por valor máximo
        if ($valorMaximo !== null && ($cotacao['valor'] ?? 0) > $valorMaximo) {
            return false;
        }

        return true;
    });
}

function real(float $v): string { return 'R$ ' . number_format($v, 2, ',', '.'); }
function classeCat(string $c): string {
    return ['Eletrônicos'=>'eletronicos','Mecânica'=>'mecanica','Consumíveis'=>'consumiveis','Serviços'=>'servicos'][$c] ?? 'outro';
}

// ---------------------------------------------------------------------------
// Seção 1: Processar GET (Filtro)
// ---------------------------------------------------------------------------
$filtroFornecedor = htmlspecialchars(trim($_GET['fornecedor'] ?? ''), ENT_QUOTES, 'UTF-8');
$filtroValor = filter_var($_GET['valor_max'] ?? null, FILTER_VALIDATE_FLOAT);
if ($filtroValor === false) {
    $filtroValor = null;
}
$listaFiltrada = filtrarCotacoes($cotacoesAbertas, $filtroFornecedor, $filtroValor);

// ---------------------------------------------------------------------------
// Seção 2: Processar POST (Novo Formulário)
// ---------------------------------------------------------------------------
$dados = array_fill_keys(['nome_fornecedor','email_fornecedor','categoria_produto','descricao_item','valor_cotacao','prazo_entrega_dias','condicoes_pagamento'], '');
$erros = [];
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($dados as $campo => $v) $dados[$campo] = trim((string)($_POST[$campo] ?? ''));
    $erros = validarCotacao($dados);
    if (empty($erros)) {
        $id = 1;
        foreach ($cotacoesAbertas as $c) $id = max($id, (int)($c['id'] ?? 0) + 1);
        $novaCotacao = [
            'id' => $id,
            'fornecedor' => $dados['nome_fornecedor'],
            'email' => $dados['email_fornecedor'],
            'categoria' => $dados['categoria_produto'],
            'descricao' => $dados['descricao_item'],
            'valor' => normalizarValor($dados['valor_cotacao']),
            'prazo' => (int)$dados['prazo_entrega_dias'],
            'condicao' => $dados['condicoes_pagamento'],
            'data_abertura' => date('Y-m-d'),
        ];

        $cotacoesAbertas[] = $novaCotacao;
        file_put_contents('cotacoes.json', json_encode($cotacoesAbertas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $sucesso = true;
        $dados = array_fill_keys(array_keys($dados), ''); // limpa o form após sucesso
    }
}

function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>SupplyChain SENAI</title>
<style>
* { box-sizing: border-box; } body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 0; padding: 20px; color: #222; }
.container { max-width: 1100px; margin: auto; }
h1 { background: #1e3799; color: #fff; padding: 20px; text-align: center; border-radius: 8px; margin: 0 0 20px; }
h2 { color: #1e3799; margin-top: 0; }
.card { background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,0,0,.08); }
label { font-weight: 600; font-size: .9em; }
input, select, textarea { width: 100%; padding: 9px; margin: 5px 0 14px; border: 1px solid #ccc; border-radius: 5px; font-family: inherit; }
input.erro-campo, select.erro-campo, textarea.erro-campo { border-color: #c0392b; background: #fdf1f0; }
textarea { height: 90px; }
button { background: #1e3799; color: #fff; border: 0; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
button:hover { background: #162d7d; }
.limpar { background: #777; }
.erro { color: #c0392b; font-size: .85em; margin: -10px 0 12px; }
.sucesso { background: #e8f8ee; border: 1px solid #27ae60; color: #1e7e42; padding: 10px 14px; border-radius: 6px; font-weight: 600; }
.tabela-cotacoes {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.tabela-cotacoes thead {
    background: #1e3799;
    color: white;
}
.tabela-cotacoes th, .tabela-cotacoes td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #eee;
}
.tabela-cotacoes tbody tr:hover {
    background: #f9f9f9;
}
.valor-destaque {
    color: #27ae60;
    font-weight: bold;
    font-family: 'Courier New', monospace;
}
.badge-categoria {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.85em;
    font-weight: bold;
}
.badge-categoria.eletronicos { background: #e3f2fd; color: #1565c0; }
.badge-categoria.mecanica { background: #f3e5f5; color: #6a1b9a; }
.badge-categoria.consumiveis { background: #e8f5e9; color: #2e7d32; }
.badge-categoria.servicos { background: #fff3e0; color: #e65100; }
.filtro { display: flex; flex-wrap: wrap; gap: 12px; align-items: end; }
.filtro > div { flex: 1; min-width: 160px; }
.vazio { text-align: center; color: #888; font-style: italic; padding: 16px; }
@media (max-width: 700px) { table { font-size: 12px; } th, td { padding: 6px; } .filtro { flex-direction: column; align-items: stretch; } }
</style>
</head>
<body>
<div class="container">
<h1>SupplyChain SENAI — Cotação de Fornecedores</h1>

<div class="card">
    <h2>Cotações Abertas</h2>
    <form method="GET" class="filtro">
        <div>
            <label for="fornecedor">Fornecedor</label>
            <input type="text" id="fornecedor" name="fornecedor" placeholder="Buscar por fornecedor..." value="<?= $filtroFornecedor ?>">
        </div>
        <div>
            <label for="valor_max">Valor máximo (R$)</label>
            <input type="text" id="valor_max" name="valor_max" placeholder="Ex: 5000" value="<?= h((string)($_GET['valor_max'] ?? '')) ?>">
        </div>
        <div style="flex:0 0 auto; display:flex; gap:8px;">
            <button type="submit">Filtrar</button>
            <a href="<?= h($_SERVER['PHP_SELF']) ?>"><button type="button" class="limpar">Limpar</button></a>
        </div>
    </form>

    <table class="tabela-cotacoes">
        <thead><tr><th>#</th><th>Fornecedor</th><th>Categoria</th><th>Descrição</th><th>Valor</th><th>Prazo</th><th>Pagamento</th><th>Abertura</th></tr></thead>
        <tbody>
        <?php if (!$listaFiltrada): ?>
            <tr><td colspan="8" class="vazio">Nenhuma cotação encontrada para os filtros informados.</td></tr>
        <?php else: foreach ($listaFiltrada as $c): ?>
            <tr>
                <td>#<?= (int)($c['id'] ?? 0) ?></td>
                <td><?= h((string)($c['fornecedor'] ?? '')) ?></td>
                <td><span class="badge-categoria <?= classeCat((string)($c['categoria'] ?? '')) ?>"><?= h((string)($c['categoria'] ?? '')) ?></span></td>
                <td><?= h((string)($c['descricao'] ?? '')) ?></td>
                <td class="valor-destaque"><?= real((float)($c['valor'] ?? 0)) ?></td>
                <td><?= (int)($c['prazo'] ?? 0) ?> dia(s)</td>
                <td><?= h((string)($c['condicao'] ?? '')) ?></td>
                <td><?= h((string)($c['data_abertura'] ?? '')) ?></td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>

<div class="card">
    <h2> Nova Cotação</h2>
    <?php if ($sucesso): ?><p class="sucesso"> Cotação cadastrada com sucesso!</p><?php endif; ?>
    <?php if ($erros): ?><p class="erro"> Corrija os campos destacados abaixo.</p><?php endif; ?>

    <form method="POST">
        <label for="nome_fornecedor">Nome do fornecedor</label>
        <input type="text" id="nome_fornecedor" name="nome_fornecedor" class="<?= isset($erros['nome_fornecedor']) ? 'erro-campo' : '' ?>" value="<?= h($dados['nome_fornecedor']) ?>">
        <?php if (isset($erros['nome_fornecedor'])): ?><p class="erro"><?= h($erros['nome_fornecedor']) ?></p><?php endif; ?>

        <label for="email_fornecedor">E-mail</label>
        <input type="text" id="email_fornecedor" name="email_fornecedor" class="<?= isset($erros['email_fornecedor']) ? 'erro-campo' : '' ?>" value="<?= h($dados['email_fornecedor']) ?>">
        <?php if (isset($erros['email_fornecedor'])): ?><p class="erro"><?= h($erros['email_fornecedor']) ?></p><?php endif; ?>

        <label for="categoria_produto">Categoria do produto</label>
        <select id="categoria_produto" name="categoria_produto" class="<?= isset($erros['categoria_produto']) ? 'erro-campo' : '' ?>">
            <option value="">Selecione...</option>
            <?php foreach (CATEGORIAS_PERMITIDAS as $cat): ?>
                <option value="<?= h($cat) ?>" <?= $dados['categoria_produto'] === $cat ? 'selected' : '' ?>><?= h($cat) ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($erros['categoria_produto'])): ?><p class="erro"><?= h($erros['categoria_produto']) ?></p><?php endif; ?>

        <label for="descricao_item">Descrição do item</label>
        <textarea id="descricao_item" name="descricao_item" class="<?= isset($erros['descricao_item']) ? 'erro-campo' : '' ?>"><?= h($dados['descricao_item']) ?></textarea>
        <?php if (isset($erros['descricao_item'])): ?><p class="erro"><?= h($erros['descricao_item']) ?></p><?php endif; ?>

        <label for="valor_cotacao">Valor da cotação</label>
        <input type="text" id="valor_cotacao" name="valor_cotacao" placeholder="R$ 0,00" class="<?= isset($erros['valor_cotacao']) ? 'erro-campo' : '' ?>" value="<?= h($dados['valor_cotacao']) ?>">
        <?php if (isset($erros['valor_cotacao'])): ?><p class="erro"><?= h($erros['valor_cotacao']) ?></p><?php endif; ?>

        <label for="prazo_entrega_dias">Prazo de entrega (dias)</label>
        <input type="number" id="prazo_entrega_dias" name="prazo_entrega_dias" min="1" max="60" class="<?= isset($erros['prazo_entrega_dias']) ? 'erro-campo' : '' ?>" value="<?= h($dados['prazo_entrega_dias']) ?>">
        <?php if (isset($erros['prazo_entrega_dias'])): ?><p class="erro"><?= h($erros['prazo_entrega_dias']) ?></p><?php endif; ?>

        <label for="condicoes_pagamento">Condição de pagamento</label>
        <select id="condicoes_pagamento" name="condicoes_pagamento" class="<?= isset($erros['condicoes_pagamento']) ? 'erro-campo' : '' ?>">
            <option value="">Selecione...</option>
            <?php foreach (CONDICOES_PAGAMENTO as $cond): ?>
                <option value="<?= h($cond) ?>" <?= $dados['condicoes_pagamento'] === $cond ? 'selected' : '' ?>><?= h($cond) ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($erros['condicoes_pagamento'])): ?><p class="erro"><?= h($erros['condicoes_pagamento']) ?></p><?php endif; ?>

        <button type="submit">Cadastrar Cotação</button>
    </form>
</div>

</div>
</body>
</html>
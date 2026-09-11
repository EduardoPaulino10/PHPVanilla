<?php
// variaveis
$usuario = [
    "nome" => "Carlos Eduardo",
    "idade" => 28,
    "cidade" => "Americana",
    "estado" => "SP",
    "premium" => true
];
// ve se o usuário é premium e adiciona uma estrela ao nome
if ($usuario['premium'] == true) {
    $estrela = "⭐";
} else {
    $estrela = "";
}
?>
<!-- parte html -->
<div style="border: 1px solid #ccc; padding: 15px; width: 250px; font-family: sans-serif;">
    <h3><?php echo $usuario['nome']; ?> <?php echo $estrela; ?></h3>
    <p>Idade: <?php echo $usuario['idade']; ?> anos</p>
    <p>Local: <?php echo $usuario['cidade']; ?> - <?php echo $usuario['estado']; ?></p>
</div>
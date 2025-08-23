<?php
require_once "conexao.php";
require_once "funcoes.php";

$avaliacoes = listarAvaliacao($conexao);

echo "<pre>";
print_r($avaliacoes);
echo "</pre>";
?>

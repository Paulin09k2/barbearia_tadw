<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$id_barbeiro = 1;

$resultado = deletarBarbeiro($conexao, $id_barbeiro);

echo $resultado ? "Barbeiro deletado com sucesso!" : "Erro ao deletar barbeiro.";
?>

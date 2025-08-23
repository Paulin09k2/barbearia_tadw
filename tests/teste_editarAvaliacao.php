<?php
require_once "conexao.php";
require_once "funcoes.php";

$id = 1; // ID real da avaliação existente
$estrela = 4;
$comentario = "Bom, mas pode melhorar.";
$barbeiro_id_barbeiro = 1;
$servico_id_servico = 1;

if (editarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $id)) {
    echo "Avaliação editada com sucesso!";
} else {
    echo "Erro ao editar avaliação.";
}
?>

<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$estrela = 5;
$comentario = "Ótimo atendimento!";
$barbeiro_id_barbeiro = 1;
$servico_id_servico = 1;   

if (salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico)) {
    echo "Avaliação salva com sucesso!";
} else {
    echo "Erro ao salvar avaliação.";
}
?>

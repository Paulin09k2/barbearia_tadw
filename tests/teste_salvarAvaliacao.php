<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$estrela = 5;
$comentario = "Ótimo atendimento!";
$barbeiro_id_barbeiro = 1; // Altere conforme o ID do barbeiro existente
$servico_id_servico = 1;   // Altere conforme o ID do serviço existente

if (salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico)) {
    echo "Avaliação salva com sucesso!";
} else {
    echo "Erro ao salvar avaliação.";
}
?>

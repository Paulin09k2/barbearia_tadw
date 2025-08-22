<?php 
require_once "../conexao.php";
require_once "../funcoes.php";

$data_agendamento = "2025-09-01 14:30:00";
$status = "pendente";
$barbeiro_id = 1; 
$cliente_id = 1;  

$resultado = salvarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id, $cliente_id);

echo $resultado;
?>

<?php
require_once "conexao.php";
require_once "funcoes.php";

$data_agendamento = "2025-09-02 10:00:00";
$status = "confirmado";
$barbeiro_id = 1;
$cliente_id = 1;
$id_agendamento = 1;

$resultado = editarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id, $cliente_id, $id_agendamento);

echo $resultado;
?>

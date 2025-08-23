<?php
require_once "conexao.php";
require_once "funcoes.php";

$id_agendamento = 1;
$barbeiro_id = 1;
$cliente_id = 1;

$resultado = deletarAgendamento($conexao, $id_agendamento, $barbeiro_id, $cliente_id);

echo $resultado;
?>

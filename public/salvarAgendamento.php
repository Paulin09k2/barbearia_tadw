<?php
require_once "./conexao.php";
require_once "./funcoes.php";
session_start();

$id_agendamento = $_POST['id_agendamento'] ?? 0;
$id_cliente = $_POST['id_cliente'] ?? 0;
$data_agendamento = $_POST['data_agendamento'] ?? '';
$status = $_POST['status'] ?? 'pendente';
$barbeiro_id_barbeiro = $_POST['barbeiro_id'] ?? 0;
$servico_id_servico = $_POST['servico_id'] ?? 0;


$disponivel = verificarHorarioDisponivel($conexao, $barbeiro_id_barbeiro, $data_agendamento, $id_agendamento == 0 ? null : $id_agendamento);

if (!$disponivel) {
  $_SESSION['mensagem'] = "⚠️ Esse horário já está ocupado para o barbeiro selecionado!";
  header("Location: ./cliente/index.php");
  exit;
}

if ($id_agendamento == 0) {
  $novo = salvarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $id_cliente);

  if ($novo) {
    salvarAgendaServico($conexao, $novo, $servico_id_servico);
    $_SESSION['mensagem'] = "✅ Agendamento realizado com sucesso!";
  } else {
    $_SESSION['mensagem'] = "❌ Erro ao salvar o agendamento.";
  }
  header("Location: ./cliente/index.php");
  exit;
} else {
  if (empty($data_agendamento) || empty($barbeiro_id_barbeiro) || empty($id_cliente) || empty($servico_id_servico)) {
    $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios!";
    header("Location: ./formAgendamento.php");
    exit;
  }
  $ok = editarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $id_cliente, $id_agendamento);
  $_SESSION['mensagem'] = $ok ? "✏️ Agendamento atualizado com sucesso!" : "❌ Erro ao atualizar o agendamento.";
  header("Location: ./admin/gerenciador.php");
}

exit;

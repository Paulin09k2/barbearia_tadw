<?php
// Importa o arquivo de conexão com o banco de dados.
require_once "./conexao.php";

// Importa o arquivo com funções auxiliares (como salvarAgendamento, editarAgendamento, etc.).
require_once "./funcoes.php";

// Inicia ou continua a sessão (necessária para salvar mensagens e dados de login).
session_start();


// --- Coleta e valida os dados enviados via formulário (POST) ---
$id_agendamento = $_POST['id_agendamento'] ?? 0;         // ID do agendamento (0 = novo)
$id_cliente = $_POST['id_cliente'] ?? 0;                 // ID do cliente que está agendando
$data_agendamento = $_POST['data_agendamento'] ?? '';     // Data e hora do agendamento
$status = $_POST['status'] ?? 'pendente';                // Status inicial do agendamento (padrão: pendente)
$barbeiro_id_barbeiro = $_POST['barbeiro_id'] ?? 0;      // ID do barbeiro selecionado
$servico_id_servico = $_POST['servico_id'] ?? 0;          // ID do serviço escolhido


// --- Verifica se o horário está disponível para o barbeiro selecionado ---
$disponivel = verificarHorarioDisponivel(
  $conexao,
  $barbeiro_id_barbeiro,
  $data_agendamento,
  $id_agendamento == 0 ? null : $id_agendamento // Se for edição, ignora o próprio agendamento
);

// Caso o horário já esteja ocupado, exibe mensagem e redireciona para a página do cliente.
if (!$disponivel) {
  $_SESSION['mensagem'] = "⚠️ Esse horário já está ocupado para o barbeiro selecionado!";
  header("Location: ./cliente/index.php");
  exit;
}


// --- Se for um novo agendamento ---
if ($id_agendamento == 0) {

  // Salva o novo agendamento (retorna o ID do novo registro).
  $novo = salvarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $id_cliente);

  if ($novo) {
    // Relaciona o serviço ao agendamento na tabela intermediária.
    salvarAgendaServico($conexao, $novo, $servico_id_servico);
    $_SESSION['mensagem'] = "✅ Agendamento realizado com sucesso!";
  } else {
    $_SESSION['mensagem'] = "❌ Erro ao salvar o agendamento.";
  }

  // Redireciona de volta para o painel do cliente.
  header("Location: ./cliente/index.php");
  exit;

} else {
  // --- Caso seja uma edição de agendamento existente ---

  // Verifica se os campos obrigatórios foram preenchidos.
  if (empty($data_agendamento) || empty($barbeiro_id_barbeiro) || empty($id_cliente) || empty($servico_id_servico)) {
    $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios!";
    header("Location: ./formAgendamento.php");
    exit;
  }

  // Atualiza os dados do agendamento no banco.
  $ok = editarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $id_cliente, $id_agendamento);

  // Define mensagem de sucesso ou erro conforme o retorno da função.
  $_SESSION['mensagem'] = $ok
    ? "✏️ Agendamento atualizado com sucesso!"
    : "❌ Erro ao atualizar o agendamento.";

  // Redireciona para a página de gerenciamento (painel do barbeiro/admin).
  header("Location: ./admin/gerenciador.php");
}

// Encerra o script completamente.
exit;

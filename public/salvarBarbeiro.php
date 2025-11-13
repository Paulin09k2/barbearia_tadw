<?php
// Inicia ou continua a sessão
session_start();

// Importa a conexão e funções auxiliares
require_once './conexao.php';
require_once './funcoes.php';

// Verifica se o barbeiro está logado
if (empty($_SESSION['idusuario'])) {
  header("Location: ../login.php");
  exit;
}

// Captura o ID do usuário logado (barbeiro)
$idusuario = $_SESSION['idusuario'];

// Busca o barbeiro vinculado ao usuário logado
$barbeiro = pesquisarBarbeiroId($conexao, $idusuario);

if (!$barbeiro) {
  echo "<script>alert('Barbeiro não encontrado. Faça login novamente.'); window.location='../login.php';</script>";
  exit;
}

// --- Captura os dados enviados pelo formulário ---
$nome = trim($_POST['nome'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$data_nascimento = $_POST['data_nascimento'] ?? '';
$data_admissao = $_POST['data_admissao'] ?? ''; // campo opcional
$id_barbeiro = $barbeiro['id_barbeiro']; // usa o id do barbeiro logado

// --- Atualiza os dados do barbeiro no banco ---
$resposta = editarBarbeiro(
  $conexao,
  $nome,
  $telefone,
  $cpf,
  $data_nascimento,
  $data_admissao,
  $idusuario,
  $id_barbeiro
);

// --- Verifica o resultado e redireciona ---
if ($resposta) {
  $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
} else {
  $_SESSION['mensagem'] = "Erro ao atualizar o perfil. Tente novamente.";
}

header("Location: login.php"); // volta para a página de perfil
exit;
?>

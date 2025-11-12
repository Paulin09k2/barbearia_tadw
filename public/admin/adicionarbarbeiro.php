<?php
// Página wrapper para adicionar barbeiro a partir do painel admin.
// Faz apenas checagem de permissão e redireciona para o formulário principal.
session_start();
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../funcoes.php';

// Checa autenticação
if (!isset($_SESSION['idusuario']) || !isset($_SESSION['tipo_usuario'])) {
  header('Location: ../login.php');
  exit;
}

// Normaliza tipo e permite apenas admin (3)
$tipo = $_SESSION['tipo_usuario'];
if (!is_int($tipo)) {
  $t = strtolower(trim((string)$tipo));
  if ($t === 'barbeiro' || $t === '2') $tipo = 2;
  elseif ($t === 'admin' || $t === '3') $tipo = 3;
  else $tipo = 1;
}

if ($tipo !== 3) {
  echo "<script>alert('Acesso negado: somente administradores podem adicionar barbeiros.'); window.location='../admin/index.php';</script>";
  exit;
}

// se chegou aqui, é admin — redireciona para o formulário de barbeiro
header('Location: ../formBarbeiro.php');
exit;

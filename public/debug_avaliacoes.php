<?php
session_start();
require_once 'conexao.php';
require_once 'funcoes.php';

// Verifica se está logado
if (!isset($_SESSION['idusuario'])) {
  echo "Não logado. <a href='./login.php'>Fazer login</a>";
  exit;
}

$idusuario = $_SESSION['idusuario'];
$cliente = pesquisarClienteId($conexao, $idusuario);

if (!$cliente) {
  echo "Usuário não é cliente.";
  exit;
}

$id_cliente = $cliente['id_cliente'];

echo "<h2>Debug: Avaliações para Cliente ID: " . htmlspecialchars($id_cliente) . "</h2>";

// Query 1: Verifica se existem avaliações
$sql1 = "SELECT COUNT(*) AS total FROM avaliacao WHERE cliente_id_cliente = ?";
$stmt1 = mysqli_prepare($conexao, $sql1);
mysqli_stmt_bind_param($stmt1, "i", $id_cliente);
mysqli_stmt_execute($stmt1);
$res1 = mysqli_stmt_get_result($stmt1);
$row1 = mysqli_fetch_assoc($res1);
echo "<p><strong>Total de avaliações no banco:</strong> " . $row1['total'] . "</p>";
mysqli_stmt_close($stmt1);

// Query 2: Lista todas as avaliações
$sql2 = "SELECT * FROM avaliacao WHERE cliente_id_cliente = ? ORDER BY idavaliacao DESC";
$stmt2 = mysqli_prepare($conexao, $sql2);
mysqli_stmt_bind_param($stmt2, "i", $id_cliente);
mysqli_stmt_execute($stmt2);
$res2 = mysqli_stmt_get_result($stmt2);

echo "<h3>Dados Brutos:</h3>";
while ($row = mysqli_fetch_assoc($res2)) {
  echo "<pre>";
  print_r($row);
  echo "</pre>";
}
mysqli_stmt_close($stmt2);

// Query 3: Com JOINs (como a função faz)
echo "<h3>Com JOINs (como exibido):</h3>";
$avaliacoes = listarAvaliacaoPorCliente($conexao, $id_cliente);
echo "<p>Registros retornados: " . count($avaliacoes) . "</p>";
if (!empty($avaliacoes)) {
  echo "<pre>";
  print_r($avaliacoes);
  echo "</pre>";
} else {
  echo "<p style='color: red;'>Nenhuma avaliação encontrada com JOINs!</p>";
}

echo "<br><a href='./cliente/index.php'>Voltar ao painel</a>";

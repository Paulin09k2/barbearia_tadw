<?php
session_start();
require_once '../conexao.php';
require_once '../funcoes.php';


$idusuario = $_SESSION['idusuario'];

$usuario = listarCompletoCliente($conexao, $idusuario);

$id_cliente = $usuario[0]['id_cliente'] ?? null;

if (!$id_cliente) {
  echo "<script>alert('Erro: cliente não identificado!'); window.location='../login.php';</script>";
  exit;
}
if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Cliente</title>
</head>

<h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h1>

<!-- === SEÇÃO DE AGENDAMENTOS === -->
<section>
  <h2>Seus Agendamentos</h2>
  <?php
  $agenda = listarResumoCliente($conexao, $id_cliente);

  if (empty($agenda)) {
    echo "<p>Você não possui agendamentos no momento.</p>";
    echo "<a href='../formAgendamento.php'>Agendar um serviço agora</a>";
  } else {
    foreach ($agenda as $agendamento) {
      echo "<div>";
      echo "<p><strong>Data:</strong> " . htmlspecialchars($agendamento['data_agendamento']) . "</p>";
      echo "<p><strong>Tempo estimado:</strong> " . htmlspecialchars($agendamento['tempo_estimado']) . " min</p>";
      echo "<p><strong>Barbeiro:</strong> " . htmlspecialchars($agendamento['nome_barbeiro']) . "</p>";
      echo "<p><strong>Serviço:</strong> " . htmlspecialchars($agendamento['nome_servico']) . "</p>";
      echo "</div><hr>";
    }
  }
  ?>
</section>

<!-- === SEÇÃO DE AVALIAÇÕES === -->
<section>
  <h2>Suas Avaliações</h2>
  <?php
  $avaliacoes = listarAvaliacaoPorCliente($conexao, $id_cliente);

  if (empty($avaliacoes)) {
    echo "<p>Você ainda não fez nenhuma avaliação.</p>";
  } else {
    foreach ($avaliacoes as $a) {
      echo "<div>";
      echo "<p><strong>Serviço:</strong> " . htmlspecialchars($a['nome_servico']) . "</p>";
      echo "<p><strong>Barbeiro:</strong> " . htmlspecialchars($a['nome_barbeiro']) . "</p>";
      echo "<p><strong>Nota:</strong> " . htmlspecialchars($a['estrela']) . " ⭐</p>";
      echo "<p><em>" . htmlspecialchars($a['comentario']) . "</em></p>";

      if (!empty($a['foto'])) {
        echo "<img src='../uploads/" . htmlspecialchars($a['foto']) . "' alt='foto da avaliação' width='100'>";
      }

      echo "</div><hr>";
    }
  }
  ?>
</section>
<body>
  <nav>
    <ul>
      <li><a href="./index.php">Início</a></li>
      <li><a href="../formAgendamento.php">Agendamentos</a></li>
      <li><a href="./avaliacao.php">Avaliações</a></li>
      <li><a href="./servico.php">Serviços</a></li>
      <li><a href="../formCliente.php?id=<?php echo $idusuario; ?>">Editar Perfil</a></li>
      <li><a href="../sair.php">Sair</a></li>
    </ul>
  </nav>


</body>
</html>

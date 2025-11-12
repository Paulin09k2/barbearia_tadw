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

  <style>
    /* Remove margens padrão e define fundo com gradiente */
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #060b11, #0f1f33);
      min-height: 100vh;
      color: #d7d3cc;
    }

    /* Navegação lateral superior */
    nav {
      background-color: #0f1f33;
      padding: 20px;
      border-bottom: 2px solid #222;
    }

    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      gap: 30px;
    }

    nav ul li a {
      color: #d7d3cc;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
    }

    nav ul li a:hover {
      color: #ffffff;
    }

    /* Título principal */
    h1 {
      text-align: center;
      margin-top: 40px;
      font-size: 28px;
      color: #ffffff;
    }

    /* Títulos das seções */
    section h2 {
      color: #d7d3cc;
      border-bottom: 2px solid #444;
      padding-bottom: 8px;
      margin: 40px 0 20px 0;
      text-align: center;
    }

    /* Cada bloco de agendamento ou avaliação */
    section div {
      background-color: #16263f;
      padding: 20px;
      border-radius: 15px;
      margin: 15px auto;
      width: 80%;
      max-width: 600px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    section p {
      margin: 8px 0;
      line-height: 1.4;
    }

    section img {
      display: block;
      margin: 10px auto;
      border-radius: 10px;
    }

    /* Links de ação */
    a {
      color: #d7d3cc;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
      margin-top: 10px;
      transition: color 0.3s;
    }

    a:hover {
      color: #ffffff;
      text-decoration: underline;
    }

    /* Linha divisória */
    hr {
      border: 0;
      height: 1px;
      background-color: #333;
      margin: 20px auto;
      width: 80%;
    }
  </style>
</head>

<body>
  <nav>
    <ul>
      <li><a href="../formAgendamento.php">Agendamentos</a></li>
      <li><a href="./avaliacao.php">Avaliações</a></li>
      <li><a href="./servico.php">Serviços</a></li>
      <li><a href="../formCliente.php?id=<?php echo $idusuario; ?>">Editar Perfil</a></li>
      <li><a href="../sair.php">Sair</a></li>
    </ul>
  </nav>

  <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h1>

  <!-- === SEÇÃO DE AGENDAMENTOS === -->
  <section>
    <h2>Seus Agendamentos</h2>
    <?php
    $agenda = listarResumoCliente($conexao, $id_cliente);

    if (empty($agenda)) {
      echo "<p style='text-align:center;'>Você não possui agendamentos no momento.</p>";
      echo "<div style='text-align:center;'><a href=\"../formAgendamento.php\">Agendar um serviço agora</a></div>";
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
    // mostra avaliação recente salva em sessão (se houver) antes das avaliações do banco
    $mostrou_recente = false;
    if (!empty($_SESSION['ultima_avaliacao'])) {
      $u = $_SESSION['ultima_avaliacao'];
      echo "<div style='background-color:#17314a;padding:15px;border-radius:10px;margin:15px auto;width:80%;max-width:600px;'>";
      echo "<p><strong>Serviço:</strong> " . htmlspecialchars($u['nome_servico'] ?? $u['servico'] ?? '—') . " <span style='color:#ffd54f'>(Recente)</span></p>";
      echo "<p><strong>Barbeiro:</strong> " . htmlspecialchars($u['nome_barbeiro'] ?? $u['barbeiro'] ?? '—') . "</p>";
      echo "<p><strong>Nota:</strong> " . htmlspecialchars($u['estrela'] ?? $u['nota'] ?? '') . " ⭐</p>";
      echo "<p><em>" . nl2br(htmlspecialchars($u['comentario'] ?? '')) . "</em></p>";
      if (!empty($u['foto'])) {
        echo "<img src='../uploads/" . htmlspecialchars($u['foto']) . "' alt='foto da avaliação' width='100' style='display:block;margin:10px auto;border-radius:8px;'>";
      }
      echo "</div><hr>";
      $mostrou_recente = true;
      unset($_SESSION['ultima_avaliacao']);
    }

    // busca avaliações do banco
    $avaliacoes = listarAvaliacaoPorCliente($conexao, $id_cliente);

    if (empty($avaliacoes)) {
      echo "<p style='text-align:center;'>Você não fez nenhuma avaliação ainda.</p>";
      echo "<div style='text-align:center;'><a href=\"./avaliacao.php\">Deixar uma avaliação agora</a></div>";
    } else {
      echo "<p style='text-align:center; color: #ffd54f;'><strong>Total de avaliações: " . count($avaliacoes) . "</strong></p>";
      foreach ($avaliacoes as $avaliacao) {
        echo "<div>";
        echo "<p><strong>Serviço:</strong> " . htmlspecialchars($avaliacao['nome_servico']) . "</p>";
        echo "<p><strong>Barbeiro:</strong> " . htmlspecialchars($avaliacao['nome_barbeiro']) . "</p>";
        echo "<p><strong>Nota:</strong> " . htmlspecialchars($avaliacao['estrela']) . " ⭐</p>";
        if (!empty($avaliacao['comentario'])) {
          echo "<p><em>" . nl2br(htmlspecialchars($avaliacao['comentario'])) . "</em></p>";
        }
        if (!empty($avaliacao['foto'])) {
          echo "<img src='../img/avaliacoes/" . htmlspecialchars($avaliacao['foto']) . "' alt='Foto da avaliação' width='150' style='border-radius: 8px; display: block; margin: 10px auto;'>";
        }
        echo "<div style='margin-top: 10px;'>";
        echo "<a href='../excluirAvaliacao.php?id=" . htmlspecialchars($avaliacao['idavaliacao']) . "&from=cliente' style='color: #ff6b6b;' onclick=\"return confirm('Tem certeza que deseja deletar esta avaliação?')\">🗑️ Deletar</a>";
        echo "</div>";
        echo "</div><hr>";
      }
    }
    ?>
  </section>

</body>

</html>
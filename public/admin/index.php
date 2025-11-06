<?php
session_start();
require_once '../conexao.php';
require_once '../funcoes.php';

$idusuario = $_SESSION['id_barbeiro'] ?? 0;
$barbeiro = pesquisarBarbeiroId($conexao, $idusuario);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Barbeiro - Barbearia Elite</title>
  <style>
    /* ======= ESTILO GERAL ======= */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0a0a14, #1b1b2f);
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      margin-top: 40px;
      color: #f5b100;
      font-size: 2em;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-align: center;
    }

    h3, h4 {
      color: #f5b100;
      margin-top: 20px;
      text-align: center;
    }

    p {
      font-size: 1em;
      color: #ddd;
      text-align: center;
      margin: 5px 0;
    }

    section {
      background-color: #111827;
      padding: 25px;
      border-radius: 10px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
      margin-top: 30px;
    }

    /* ======= NAVBAR ======= */
    nav {
      margin-top: 40px;
      width: 100%;
      background-color: #111827;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    nav ul {
      list-style: none;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin: 0;
      padding: 10px 0;
      gap: 15px;
    }

    nav ul li {
      display: inline-block;
    }

    nav ul li a {
      text-decoration: none;
      color: #f5b100;
      font-weight: bold;
      text-transform: uppercase;
      padding: 10px 18px;
      border-radius: 6px;
      transition: 0.3s;
    }

    nav ul li a:hover {
      background-color: #f5b100;
      color: #111;
    }

    /* ======= RESPONSIVO ======= */
    @media (max-width: 768px) {
      h1 {
        font-size: 1.6em;
      }

      section {
        width: 95%;
      }

      nav ul {
        flex-direction: column;
        align-items: center;
      }

      nav ul li a {
        display: block;
        width: 80%;
        text-align: center;
      }
    }
  </style>
</head>

<body>

  <h1>Bem-vindo, <?= htmlspecialchars($barbeiro['nome']); ?>!</h1>

  <section>
    <?php
    $resumo = obterResumoPainelBarbeiro($conexao, $barbeiro['id_barbeiro']);

    echo "<h3>Resumo do Barbeiro</h3>";
    echo "<p>Total de Clientes: {$resumo['total_clientes']}</p>";
    echo "<p>Total de Serviços: {$resumo['total_servicos']}</p>";

    echo "<h4>Próximos Agendamentos:</h4>";
    if (count($resumo['proximos_agendamentos']) > 0) {
      foreach ($resumo['proximos_agendamentos'] as $ag) {
        echo "<p>📅 " . date('d/m/Y H:i', strtotime($ag['data_agendamento'])) . " - " . htmlspecialchars($ag['nome_cliente']) . "</p>";
      }
    } else {
      echo "<p>Nenhum agendamento futuro encontrado.</p>";
    }
    ?>
  </section>

  <nav>
    <ul>
      <li><a href="./index.php">Início</a></li>
      <li><a href="./gerenciador.php">Gerenciar</a></li>
      <li><a href="./avaliacao.php">Avaliações</a></li>
      <li><a href="./servico.php">Serviços</a></li>
      <li><a href="../formBarbeiro.php?id=<?= $idusuario; ?>">Editar Perfil</a></li>
      <li><a href="../sair.php">Sair</a></li>
    </ul>
  </nav>

</body>
</html>

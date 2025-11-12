<?php
session_start();
require_once '../conexao.php';
require_once '../funcoes.php';


$idusuario = $_SESSION['id_barbeiro'] ?? 0;


$barbeiro = pesquisarBarbeiroId($conexao, $idusuario);
// var_dump($barbeiro);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Barbeiro</title>
</head>

<body>
  <nav>
    <ul>
      <li><a href="./index.php">Início</a></li>
      <li><a href="./gerenciador.php">Gerenciar</a></li>
      <li><a href="./avaliacao.php">Avaliações</a></li>
      <li><a href="./servico.php">Serviços</a></li>
      <li><a href="adicionarbarbeiro.php">Adicionar Barbeiro</a></li>
      <li><a href="../formBarbeiro.php?id=<?php echo $idusuario; ?>">Editar Perfil</a></li>
      <li><a href="../sair.php">Sair</a></li>
    </ul>
  </nav>


  <section>
    <?php
    $resumo = obterResumoPainelBarbeiro($conexao, $barbeiro['id_barbeiro']);

    echo "<h3>Resumo do Barbeiro</h3>";
    echo "<p>Total de Clientes: {$resumo['total_clientes']}</p>";
    echo "<p>Total de Serviços: {$resumo['total_servicos']}</p>";

    echo "<h4>Próximos Agendamentos:</h4>";
    if (count($resumo['proximos_agendamentos']) > 0) {
      foreach ($resumo['proximos_agendamentos'] as $ag) {
        echo "<p>{$ag['data_agendamento']} - {$ag['nome_cliente']}</p>";
      }
    } else {
      echo "<p>Nenhum agendamento futuro encontrado.</p>";
    }
    ?>
  </section>

</body>

</html>
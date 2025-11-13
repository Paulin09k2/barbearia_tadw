<?php
session_start();
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../funcoes.php';

// Verifica se usuário está logado
if (empty($_SESSION['idusuario'])) {
  header('Location: ../login.php');
  exit;
}

$usuario_id = $_SESSION['idusuario'];
$barbeiro = pesquisarBarbeiroId($conexao, $usuario_id);
if (!$barbeiro) {
  echo "<script>alert('Barbeiro não encontrado. Faça login novamente.'); window.location='../login.php';</script>";
  exit;
}

$idBarbeiro = $barbeiro['id_barbeiro'];
$resumo = obterResumoPainelBarbeiro($conexao, $idBarbeiro);
$media = calcularMediaAvaliacoes($conexao, $idBarbeiro);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Barbeiro - <?php echo htmlspecialchars($barbeiro['nome']); ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" href="../logo.png" type="image/png">
</head>

<body class="bg-gray-900 text-white min-h-screen">
  <header class="bg-[#0d1b2a] p-4 flex justify-between items-center">
    <div class="flex items-center gap-4">
      <img src="../logo.png" class="w-12 h-12 rounded-full" alt="logo">
      <div>
        <h1 class="text-2xl font-bold">Painel do Barbeiro</h1>
        <p class="text-sm text-gray-300">Bem-vindo, <?php echo htmlspecialchars($barbeiro['nome']); ?></p>
      </div>
    </div>
    <nav class="space-x-4">
      <a href="servicosregistrado.php" class="bg-white text-black px-3 py-1 rounded">Meus Serviços</a>
      <a href="avaliacao.php" class="bg-white text-black px-3 py-1 rounded">Avaliações</a>
      <a href="editar.php" class="bg-white text-black px-3 py-1 rounded">Editar Perfil</a>
      <a href="../sair.php" class="bg-red-600 px-3 py-1 rounded">Sair</a>
    </nav>
  </header>

  <main class="p-6">
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-[#0f1724] p-6 rounded shadow">
        <h3 class="text-lg font-semibold">Média de avaliações</h3>
        <p class="text-4xl font-bold mt-4"><?php echo $media; ?> <span class="text-sm text-gray-400">/5</span></p>
      </div>
      <div class="bg-[#0f1724] p-6 rounded shadow">
        <h3 class="text-lg font-semibold">Próximos agendamentos</h3>
        <ul class="mt-4 text-sm text-gray-300">
          <?php if (empty($resumo['proximos_agendamentos'])): ?>
            <li>Nenhum agendamento próximo</li>
          <?php else: ?>
            <?php foreach ($resumo['proximos_agendamentos'] as $ag): ?>
              <li><?php echo date('d/m/Y H:i', strtotime($ag['data_agendamento'])); ?> — <?php echo htmlspecialchars($ag['nome_cliente']); ?></li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </div>
      <div class="bg-[#0f1724] p-6 rounded shadow">
        <h3 class="text-lg font-semibold">Resumo</h3>
        <p class="mt-4">Clientes atendidos: <strong><?php echo $resumo['total_clientes'] ?? 0; ?></strong></p>
        <p>Serviços realizados: <strong><?php echo $resumo['total_servicos'] ?? 0; ?></strong></p>
      </div>
    </section>

    <section class="bg-[#071022] p-6 rounded">
      <h2 class="text-xl font-bold mb-4">Últimas avaliações</h2>
      <?php
      // Busca as últimas 5 avaliações deste barbeiro
      $sql = "SELECT a.idavaliacao, a.estrela, a.comentario, c.nome AS nome_cliente, s.nome_servico, a.foto
							FROM avaliacao a
							INNER JOIN cliente c ON a.cliente_id_cliente = c.id_cliente
							INNER JOIN servico s ON a.servico_id_servico = s.id_servico
							WHERE a.barbeiro_id_barbeiro = ? ORDER BY a.idavaliacao DESC LIMIT 5";
      $stmt = mysqli_prepare($conexao, $sql);
      mysqli_stmt_bind_param($stmt, 'i', $idBarbeiro);
      mysqli_stmt_execute($stmt);
      $res = mysqli_stmt_get_result($stmt);
      $ultimas = [];
      while ($row = mysqli_fetch_assoc($res)) $ultimas[] = $row;
      mysqli_stmt_close($stmt);
      ?>
      <?php if (empty($ultimas)): ?>
        <p class="text-gray-400">Nenhuma avaliação ainda.</p>
      <?php else: ?>
        <div class="space-y-4">
          <?php foreach ($ultimas as $av): ?>
            <div class="p-4 bg-[#0f1724] rounded">
              <div class="flex justify-between items-start">
                <div>
                  <h4 class="font-semibold"><?php echo htmlspecialchars($av['nome_cliente']); ?></h4>
                  <p class="text-sm text-gray-400">Serviço: <?php echo htmlspecialchars($av['nome_servico']); ?></p>
                </div>
                <div class="text-right">
                  <div class="text-yellow-400 font-bold">⭐ <?php echo intval($av['estrela']); ?>/5</div>
                </div>
              </div>
              <?php if (!empty($av['comentario'])): ?>
                <p class="mt-2 text-gray-300"><?php echo htmlspecialchars($av['comentario']); ?></p>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
  </main>

  <footer class="p-4 text-center text-gray-400">© 2025 Barbearia Elite</footer>
</body>

</html>
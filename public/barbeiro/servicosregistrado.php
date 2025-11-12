<?php
session_start();
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../funcoes.php';

if (empty($_SESSION['idusuario'])) {
  header('Location: ../login.php');
  exit;
}

$usuario_id = $_SESSION['idusuario'];
$barbeiro = pesquisarBarbeiroId($conexao, $usuario_id);
if (!$barbeiro) {
  echo "<script>alert('Barbeiro não encontrado.'); window.location='../login.php';</script>";
  exit;
}

$idBarbeiro = $barbeiro['id_barbeiro'];

// Busca serviços associados aos agendamentos desse barbeiro
$sql = "SELECT DISTINCT s.id_servico, s.nome_servico, s.descricao, s.preco
				FROM servico s
				INNER JOIN agenda_servico ags ON s.id_servico = ags.servico_id_servico
				INNER JOIN agendamento a ON ags.agendamento_id_agendamento = a.id_agendamento
				WHERE a.barbeiro_id_barbeiro = ?
				ORDER BY s.nome_servico ASC";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, 'i', $idBarbeiro);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$servicos = [];
while ($row = mysqli_fetch_assoc($res)) $servicos[] = $row;
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meus Serviços</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen">
  <header class="p-4 bg-[#0d1b2a] flex justify-between items-center">
    <h1 class="text-xl font-bold">Serviços registrados</h1>
    <a href="index.php" class="bg-white text-black px-3 py-1 rounded">Voltar</a>
  </header>

  <main class="p-6">
    <?php if (empty($servicos)): ?>
      <p class="text-gray-400">Nenhum serviço registrado para este barbeiro.</p>
    <?php else: ?>
      <div class="grid md:grid-cols-2 gap-4">
        <?php foreach ($servicos as $s): ?>
          <div class="bg-[#0f1724] p-4 rounded">
            <h3 class="font-semibold text-lg"><?php echo htmlspecialchars($s['nome_servico']); ?></h3>
            <p class="text-gray-300 text-sm mt-2"><?php echo htmlspecialchars($s['descricao']); ?></p>
            <p class="mt-3 font-bold">R$ <?php echo number_format($s['preco'], 2, ',', '.'); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main>
  <footer class="p-4 text-center text-gray-400">© 2025 Barbearia Elite</footer>
</body>

</html>
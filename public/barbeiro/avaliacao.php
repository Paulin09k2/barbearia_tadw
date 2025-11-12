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

// Busca avaliações do barbeiro logado
$sql = "SELECT a.idavaliacao, a.estrela, a.comentario, a.foto, c.nome AS cliente, s.nome_servico
				FROM avaliacao a
				INNER JOIN cliente c ON a.cliente_id_cliente = c.id_cliente
				INNER JOIN servico s ON a.servico_id_servico = s.id_servico
				WHERE a.barbeiro_id_barbeiro = ?
				ORDER BY a.idavaliacao DESC";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, 'i', $idBarbeiro);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$avaliacoes = [];
while ($row = mysqli_fetch_assoc($res)) $avaliacoes[] = $row;
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Avaliações - Meus</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen">
  <header class="p-4 bg-[#0d1b2a] flex justify-between items-center">
    <h1 class="text-xl font-bold">Avaliações recebidas</h1>
    <a href="index.php" class="bg-white text-black px-3 py-1 rounded">Voltar</a>
  </header>

  <main class="p-6">
    <?php if (empty($avaliacoes)): ?>
      <p class="text-gray-400">Nenhuma avaliação para este barbeiro.</p>
    <?php else: ?>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-[#071022] rounded">
          <thead>
            <tr class="text-left border-b border-gray-700">
              <th class="p-3">#</th>
              <th class="p-3">Cliente</th>
              <th class="p-3">Serviço</th>
              <th class="p-3">Estrela</th>
              <th class="p-3">Comentário</th>
              <th class="p-3">Foto</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($avaliacoes as $a): ?>
              <tr class="border-b border-gray-800">
                <td class="p-3"><?php echo intval($a['idavaliacao']); ?></td>
                <td class="p-3"><?php echo htmlspecialchars($a['cliente']); ?></td>
                <td class="p-3"><?php echo htmlspecialchars($a['nome_servico']); ?></td>
                <td class="p-3">⭐ <?php echo intval($a['estrela']); ?>/5</td>
                <td class="p-3"><?php echo htmlspecialchars($a['comentario']); ?></td>
                <td class="p-3">
                  <?php if (!empty($a['foto'])): ?>
                    <img src="../img/avaliacoes/<?php echo htmlspecialchars($a['foto']); ?>" alt="foto" class="w-20 h-20 object-cover rounded">
                  <?php else: ?>
                    —
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </main>

  <footer class="p-4 text-center text-gray-400">© 2025 Barbearia Elite</footer>
</body>

</html>
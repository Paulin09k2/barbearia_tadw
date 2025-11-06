<?php
session_start();
require_once '../conexao.php';
require_once '../funcoes.php';

$idusuario = $_SESSION['id_barbeiro'] ?? 0;
$barbeiro = pesquisarBarbeiroId($conexao, $idusuario);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Barbeiro - Barbearia Elite</title>
  <link rel="shortcut icon" href="../logo.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* ===== Animações suaves ===== */
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 1s forwards;
    }
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* ===== Texto dourado animado ===== */
    .gold-gradient {
      background: linear-gradient(90deg, #d4af37, #ffffff, #d4af37);
      background-size: 200% 200%;
      animation: shine 4s infinite linear;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    @keyframes shine {
      0% { background-position: 0% 50%; }
      100% { background-position: 100% 50%; }
    }
  </style>
</head>

<body class="bg-gradient-to-b from-[#0b0f16] to-[#0d1117] text-white min-h-screen flex flex-col items-center">

  <!-- ======= NAVBAR ======= -->
  <header class="fixed w-full bg-[#0d1b2a]/90 backdrop-blur-md flex justify-between items-center px-10 py-4 shadow-lg z-50">
    <div class="flex items-center gap-3">
      <img src="../logo.png" alt="Logo Barbearia Elite" class="w-12 h-12 rounded-full">
      <span class="text-2xl font-semibold gold-gradient">Barbearia Elite</span>
    </div>
    <nav class="space-x-8 text-lg">
      <a href="./index.php" class="hover:text-[#d4af37] transition">Início</a>
      <a href="./gerenciador.php" class="hover:text-[#d4af37] transition">Gerenciar</a>
      <a href="./avaliacao.php" class="hover:text-[#d4af37] transition">Avaliações</a>
      <a href="./servico.php" class="hover:text-[#d4af37] transition">Serviços</a>
      <a href="../formBarbeiro.php?id=<?= $idusuario; ?>" class="hover:text-[#d4af37] transition">Editar Perfil</a>
      <a href="../sair.php" class="hover:text-red-500 transition">Sair</a>
    </nav>
  </header>

  <!-- ======= CONTEÚDO ======= -->
  <main class="flex flex-col items-center mt-32 px-6 fade-in">
    <h1 class="text-4xl md:text-5xl font-bold mb-4 gold-gradient">
      Bem-vindo, <?= htmlspecialchars($barbeiro['nome']); ?>!
    </h1>

    <p class="text-gray-300 text-center mb-8 max-w-xl">
      Aqui está o resumo do seu desempenho e seus próximos agendamentos.
    </p>

    <!-- ======= CARD DE RESUMO ======= -->
    <section class="bg-[#141a22] p-8 rounded-2xl shadow-lg border border-[#1f2937] w-full max-w-xl text-center hover:shadow-[#d4af37]/40 transition-transform transform hover:-translate-y-2">
      <?php
      $resumo = obterResumoPainelBarbeiro($conexao, $barbeiro['id_barbeiro']);

      echo "<h3 class='text-2xl font-semibold mb-4 gold-gradient'>Resumo do Barbeiro</h3>";
      echo "<p class='text-gray-300 mb-2'>Total de Clientes: <span class='text-white font-semibold'>{$resumo['total_clientes']}</span></p>";
      echo "<p class='text-gray-300 mb-6'>Total de Serviços: <span class='text-white font-semibold'>{$resumo['total_servicos']}</span></p>";

      echo "<h4 class='text-xl font-semibold mb-3 text-[#d4af37]'>Próximos Agendamentos</h4>";
      if (count($resumo['proximos_agendamentos']) > 0) {
        foreach ($resumo['proximos_agendamentos'] as $ag) {
          echo "<p class='text-gray-300 mb-1'>📅 " . date('d/m/Y H:i', strtotime($ag['data_agendamento'])) . 
               " - <span class='text-white'>" . htmlspecialchars($ag['nome_cliente']) . "</span></p>";
        }
      } else {
        echo "<p class='text-gray-400 italic'>Nenhum agendamento futuro encontrado.</p>";
      }
      ?>
    </section>

    <a href="./gerenciador.php" class="mt-10 inline-block bg-[#d4af37] text-black font-semibold px-8 py-3 rounded-xl shadow-lg hover:bg-[#e0b949] transition-transform transform hover:scale-105">
      Gerenciar Agendamentos
    </a>
  </main>

  <!-- ======= FOOTER ======= -->
  <footer class="mt-20 py-6 text-center text-gray-500 border-t border-gray-800 w-full">
    <p>© 2025 Barbearia Elite. Todos os direitos reservados.</p>
  </footer>

</body>
</html>

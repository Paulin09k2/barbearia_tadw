<?php
require_once './conexao.php';
require_once './funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbearia Elite</title>
  <link rel="shortcut icon" href="logo.png" type="image/png">
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

    /* ===== Gradiente dourado ===== */

    @keyframes shine {
      0% {
        background-position: 0% 50%;
      }

      100% {
        background-position: 100% 50%;
      }
    }

    /* ===== Carrossel infinito ===== */
    .testimonial-track {
      display: flex;
      animation: scroll 20s linear infinite;
      width: max-content;
    }

    @keyframes scroll {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-50%);
      }
    }
  </style>
</head>

<body class="bg-gradient-to-b from-[#0b0f16] to-[#0d1117] text-white flex flex-col items-center min-h-screen">

  <!-- ======= HEADER ======= -->
  <header class="fixed w-full bg-[#0d1b2a]/90 backdrop-blur-md flex justify-between items-center px-10 py-4 shadow-lg z-50">
    <div class="flex items-center gap-3">
      <img src="logo.png" alt="Logo Barbearia Elite" class="w-12 h-12 rounded-full">
      <span class="text-2xl font-semibold gold-gradient">Barbearia Elite</span>
    </div>
    <nav class="space-x-8 text-lg">
      <a href="login.php" class="hover:text-[#ffffff] transition">Login</a>
      <a href="avaliacaocliente.php" class="hover:text-[#ffffff] transition">Avaliações</a>
      <a href="servicoscliente.php" class="hover:text-[#fffdf6] transition">Serviços</a>
    </nav>
  </header>

  <!-- ======= HERO ======= -->
  <section class="mt-32 text-center px-6 fade-in">
    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 gold-gradient">Estilo Clássico, Atitude Moderna</h1>
    <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">
      Na Barbearia Elite, cada corte é uma obra de arte. Experimente o cuidado, o estilo e a precisão que definem os verdadeiros mestres da barba e cabelo.
    </p>
    <a href="login.php" class="mt-10 inline-block bg-[#ffffff] text-black font-semibold px-8 py-3 rounded-xl shadow-lg hover:bg-[#ffffff] transition-transform transform hover:scale-105">
      Agende seu Horário
    </a>
  </section>

  <!-- ======= SERVIÇOS ======= -->
  <section class="mt-24 px-8 md:px-16 fade-in">
    <h2 class="text-4xl font-bold text-center mb-12 gold-gradient">Nossos Serviços</h2>
    <div class="grid md:grid-cols-3 gap-10">
      <div class="bg-[#141a22] p-6 rounded-2xl shadow-lg hover:shadow-[#]/40 transition-transform transform hover:-translate-y-2 border border-[#1f2937]">
        <img src="../public/img/CortedeCabelo.jpeg" alt="Corte de cabelo" class="rounded-xl mb-5">
        <h3 class="text-2xl font-semibold mb-3">Corte de Cabelo</h3>
        <p class="text-gray-400 mb-4">Cortes clássicos ou modernos, com acabamento de mestre e atenção aos detalhes.</p>
        <span class="text-[#ffffff] font-semibold text-lg">R$ 45,00</span>
      </div>
      <div class="bg-[#141a22] p-6 rounded-2xl shadow-lg hover:shadow-[#]/40 transition-transform transform hover:-translate-y-2 border border-[#1f2937]">
        <img src="../public/img/BarbaPremium.jpeg" alt="Barba" class="rounded-xl mb-5">
        <h3 class="text-2xl font-semibold mb-3">Barba Premium</h3>
        <p class="text-gray-400 mb-4">Modelagem completa com toalha quente, navalha e finalização com óleo de barba.</p>
        <span class="text-[#ffffff] font-semibold text-lg">R$ 35,00</span>
      </div>
      <div class="bg-[#141a22] p-6 rounded-2xl shadow-lg hover:shadow-[#]/40 transition-transform transform hover:-translate-y-2 border border-[#1f2937]">
        <img src="../public/img/barbeiro.jpg" alt="Combo completo" class="rounded-xl mb-5">
        <h3 class="text-2xl font-semibold mb-3">Combo Elite</h3>
        <p class="text-gray-400 mb-4">Corte + Barba + Massagem facial e finalização completa. Experiência VIP.</p>
        <span class="text-[#ffffff] font-semibold text-lg">R$ 70,00</span>
      </div>
    </div>
  </section>

  <!-- ======= DEPOIMENTOS ======= -->
  <section class="py-24 bg-[#0d1117] fade-in mt-24 w-full overflow-hidden">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-bold mb-4 gold-gradient">O que nossos clientes dizem</h2>
        <p class="text-lg text-gray-400 max-w-2xl mx-auto">
          Experiências reais de quem vive o estilo e a excelência da Barbearia Elite.
        </p>
      </div>

      <?php
      // Busca todas as avaliações do banco
      $avaliacoes = listarAvaliacoes($conexao);

      if (empty($avaliacoes)):
      ?>
        <div class="text-center py-12">
          <p class="text-gray-400 text-lg">Nenhuma avaliação disponível ainda. Seja o primeiro a avaliar!</p>
        </div>
      <?php
      else:
      ?>
        <div class="testimonial-slider">
          <div class="testimonial-track">
            <?php
            // Exibe cada avaliação do banco
            foreach ($avaliacoes as $avaliacao):
            ?>
              <div class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-[#141a22] rounded-xl border border-[#2a2f3a] shadow-lg">
                <div class="flex items-center mb-4">
                  <div class="w-12 h-12 rounded-full overflow-hidden mr-4 border-2 border-[#2e2ee1] bg-gray-700 flex items-center justify-center">
                    <?php if (!empty($avaliacao['foto'])): ?>
                      <img src="./img/avaliacoes/<?php echo htmlspecialchars($avaliacao['foto']); ?>" alt="Foto da avaliação" class="object-cover w-full h-full">
                    <?php else: ?>
                      <span class="text-gray-400">👤</span>
                    <?php endif; ?>
                  </div>
                  <div>
                    <h4 class="font-bold text-[#ffffff]"><?php echo htmlspecialchars($avaliacao['nome_cliente']); ?></h4>
                    <p class="text-gray-400 text-sm">⭐ <?php echo htmlspecialchars($avaliacao['estrela']); ?>/5 - <?php echo htmlspecialchars($avaliacao['nome_barbeiro']); ?></p>
                  </div>
                </div>
                <p class="text-white/80 italic">
                  "<?php echo htmlspecialchars($avaliacao['comentario']); ?>"
                </p>
                <p class="text-gray-500 text-xs mt-3">Serviço: <?php echo htmlspecialchars($avaliacao['nome_servico']); ?></p>
              </div>
              <?php
            endforeach;

            // Duplica os primeiros itens para o efeito infinito do carrossel
            if (count($avaliacoes) > 0):
              foreach ($avaliacoes as $avaliacao):
              ?>
                <div class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-[#141a22] rounded-xl border border-[#2a2f3a] shadow-lg">
                  <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full overflow-hidden mr-4 border-2 border-[#2e2ee1] bg-gray-700 flex items-center justify-center">
                      <?php if (!empty($avaliacao['foto'])): ?>
                        <img src="./img/avaliacoes/<?php echo htmlspecialchars($avaliacao['foto']); ?>" alt="Foto da avaliação" class="object-cover w-full h-full">
                      <?php else: ?>
                        <span class="text-gray-400">👤</span>
                      <?php endif; ?>
                    </div>
                    <div>
                      <h4 class="font-bold text-[#ffffff]"><?php echo htmlspecialchars($avaliacao['nome_cliente']); ?></h4>
                      <p class="text-gray-400 text-sm">⭐ <?php echo htmlspecialchars($avaliacao['estrela']); ?>/5 - <?php echo htmlspecialchars($avaliacao['nome_barbeiro']); ?></p>
                    </div>
                  </div>
                  <p class="text-white/80 italic">
                    "<?php echo htmlspecialchars($avaliacao['comentario']); ?>"
                  </p>
                  <p class="text-gray-500 text-xs mt-3">Serviço: <?php echo htmlspecialchars($avaliacao['nome_servico']); ?></p>
                </div>
            <?php
              endforeach;
            endif;
            ?>
          </div>
        </div>
      <?php
      endif;
      ?>
    </div>
  </section>

  <!-- ======= FOOTER ======= -->
  <footer class="mt-24 py-8 text-center text-gray-400 border-t border-gray-800 w-full">
    <p>© 2025 Barbearia Elite..</p>
  </footer>

</body>

</html>
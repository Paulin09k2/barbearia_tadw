<?php
require_once "./conexao.php";
require_once "./funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Barbearia Elite</title>
  <link rel="icon" type="image/png" href="logo.png" />
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background: radial-gradient(circle at top left, #0b1220, #02050a 80%);
      font-family: "Poppins", sans-serif;
    }

    @keyframes pulse-glow {
      0% {
        opacity: 0.4;
        transform: scale(1);
      }

      100% {
        opacity: 0.8;
        transform: scale(1.1);
      }
    }

    .animate-glow {
      animation: pulse-glow 5s ease-in-out infinite alternate;
    }

    .input-icon {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      color: #9ca3af;
    }
  </style>
  
</head>
<body class="flex items-center justify-center min-h-screen relative overflow-hidden">

  <!-- Efeitos visuais de luz de fundo -->
  <div class="absolute -top-10 right-0 w-[450px] h-[450px] bg-yellow-500/10 blur-[120px] rounded-full animate-glow"></div>
  <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-yellow-400/5 blur-[120px] rounded-full animate-glow"></div>

  <!-- Container principal: divide logo e formulário -->
  <div class="flex flex-col md:flex-row items-center gap-20 p-8 z-10">

    <!-- Seção com logo e texto de boas-vindas -->
    <div class="flex flex-col items-center text-center space-y-4">
      <img src="logo.png" alt="Logo Barbearia Elite"
        class="h-60 md:h-80 drop-shadow-[0_0_15px_rgba(255,255,255,0.15)] transition-transform duration-500 hover:scale-105" />
      <h1 class="text-3xl font-bold text-gray-100 uppercase tracking-wide">Barbearia Elite</h1>
      <p class="text-gray-400 max-w-sm text-sm md:text-base leading-relaxed">
        Estilo, confiança e tradição. Faça login para agendar seu atendimento e viver a experiência Elite.
      </p>
    </div>

    <!-- Caixa do formulário de login -->
    <div
      class="bg-[#0f1f33]/90 backdrop-blur-lg p-10 md:p-12 rounded-2xl w-[350px] md:w-[400px] shadow-2xl border border-gray-800/50 hover:border-blue-900 transition-all duration-300">

      <!-- Título do formulário -->
      <h2 class="text-2xl font-semibold text-gray-100 mb-8 text-center uppercase tracking-wide">Acessar Conta</h2>

      <!-- Alerta de erro (comentado — pode ser usado para mostrar erros via PHP/JS) -->
      <!-- 
      <div class="mb-4 text-sm text-red-400 bg-red-900/30 border border-red-700/40 rounded-lg p-3 text-center">
        E-mail ou senha incorretos.
      </div> 
      -->

      <!-- Formulário de login -->
      <form action="verificarLogin.php" method="post" class="flex flex-col gap-6">

        <!-- Campo de e-mail -->
        <div class="relative">
          <span class="input-icon">
            <!-- Ícone SVG do campo e-mail -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21.75 5.25v13.5a1.5 1.5 0 01-1.5 1.5H3.75a1.5 1.5 0 01-1.5-1.5V5.25m19.5 0l-9.75 7.5-9.75-7.5" />
            </svg>
          </span>

          <!-- Input para digitar o e-mail -->
          <input type="email" name="email" placeholder="E-mail" required
            class="w-full px-12 py-3 rounded-full bg-gray-200 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-900 transition-all duration-300" />
        </div>

        <!-- Campo de senha -->
        <div class="relative">
          <span class="input-icon">
            <!-- Ícone SVG do campo senha -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.5 10.5V8.25A4.5 4.5 0 007.5 8.25v2.25m9 0H7.5m9 0v8.25a1.5 1.5 0 01-1.5 1.5H9a1.5 1.5 0 01-1.5-1.5v-8.25" />
            </svg>
          </span>

          <!-- Input para digitar a senha -->
          <input type="password" name="senha" placeholder="Senha" required
            class="w-full px-12 py-3 rounded-full bg-gray-200 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-900 transition-all duration-300" />
        </div>

        <!-- Botão de envio -->

        <button type="submit"
          class="mt-2 py-3 rounded-full bg-gradient-to-r from-gray-200 to-gray-200 text-[#0f1f33] font-bold text-lg shadow-md hover:from-blue-800 hover:to-blue-800 transition-transform transform hover:-translate-y-0.5 hover:shadow-blue-900/40">
          Entrar
        </button>

        <!-- Links para cadastro e voltar -->
        <div class="text-center mt-4 space-y-1">
          <a href="formCliente.php"
          class="text-sm text-gray-300 hover:text-blue-800 transition-colors block">Primeiro acesso</a>
          <a href="index.php" class="text-sm text-gray-300 hover:text-blue-900 transition-colors block">Voltar</a>
        </div>

      </form>
    </div>
  </div>
</body>
</html>
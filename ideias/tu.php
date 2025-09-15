<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbearia Elite - Sistema Completo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'navy': '#0f172a',
            'navy-light': '#1e293b'
          }
        }
      }
    }
  </script>
  <style>
    .fade-in {
      animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .slide-in {
      animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
      from {
        transform: translateX(-100%);
      }

      to {
        transform: translateX(0);
      }
    }
  </style>
</head>

<body class="bg-light-gray min-h-screen">
  <!-- Header -->
  <header class="bg-navy  shadow-lg">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
          <img src="logo.png" alt="0">
        </div>
        <h1 class="text-2xl font-bold">Barbearia Elite</h1>
      </div>
      <nav class="hidden md:flex space-x-6">
        <a href="login.php">login</a>
        <a href="servicosdisponiveis.php">Serviços</a>
        <a href="formAvaliaçao.php">Avaliações</a>
        <a href="formAgendar.php">Agendar</a>
        
      </nav>
      <button onclick="toggleMobileMenu()" class="md:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
  </header>

  <!-- Home Page -->
  <div id="homePage" class="page">
    <section class="bg-gradient-to-r from-navy to-navy-light text-white py-20">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-5xl font-bold mb-6 fade-in">Barbearia Elite</h2>
        <p class="text-xl mb-8 fade-in">O melhor corte para o homem moderno</p>
        <button onclick="showPage('booking')" class="bg-white text-navy px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-100 transition-colors fade-in">
          Agendar Horário
        </button>
      </div>
    </section>

    <section class="py-16">
      <div class="container mx-auto px-4">
        <h3 class="text-3xl font-bold text-center text-navy mb-12">Por que escolher a Elite?</h3>
        <div class="grid md:grid-cols-3 gap-8">
          <div class="text-center p-6 bg-white rounded-lg shadow-lg">
            <div class="text-4xl mb-4">👨‍💼</div>
            <h4 class="text-xl font-semibold text-navy mb-2">Profissionais Experientes</h4>
            <p class="text-gray-600">Barbeiros com mais de 10 anos de experiência</p>
          </div>
          <div class="text-center p-6 bg-white rounded-lg shadow-lg">
            <div class="text-4xl mb-4">⭐</div>
            <h4 class="text-xl font-semibold text-navy mb-2">Atendimento Premium</h4>
            <p class="text-gray-600">Serviço personalizado e de alta qualidade</p>
          </div>
          <div class="text-center p-6 bg-white rounded-lg shadow-lg">
            <div class="text-4xl mb-4">🕐</div>
            <h4 class="text-xl font-semibold text-navy mb-2">Horários Flexíveis</h4>
            <p class="text-gray-600">Aberto de segunda a sábado das 8h às 20h</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>

</html>
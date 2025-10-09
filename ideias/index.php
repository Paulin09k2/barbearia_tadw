<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbearia Elite</title>
  <link rel="icon" type="login" href="logo.png">
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
  <header class="bg-navy text-white  shadow-lg">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
          <img src="logo.png" alt="0">
        </div>
        <h1 class="text-2xl font-bold">Barbearia Elite</h1>
      </div>
      <nav class="hidden md:flex space-x-6">
        <a href="login.php">Login</a>
        <a href="formAvaliaçao.php">Avaliações</a>
        <a href="formAgendar.php">Agendar</a>
        <a href="formServico.php">Serviços</a>
        
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
<table>
  <tr>
    <td><img src="../public/img/curly.jpg" width="750"></td>
    <td><img src="../public/img/Buzzcut.jpg" width="650"></td>
    <td><img src="../public/img/Undercut.jpg" width="550"></td>
  </tr>
</table>
    <div class="container mx-auto px-4 py-10">
      <h2 class="text-3xl font-bold mb-6 text-center">Nossos Serviços</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-lg fade-in">
          <h3 class="text-xl font-semibold mb-4">Corte de Cabelo</h3>
          <p>Estilos modernos e clássicos para todas as ocasiões.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg fade-in" style="animation-delay: 0.2s;">
          <h3 class="text-xl font-semibold mb-4">Barba</h3>
          <p>Modelagem e cuidados para uma barba impecável.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg fade-in" style="animation-delay: 0.4s;">
          <h3 class="text-xl font-semibold mb-4">Tratamentos Capilares</h3>
          <p>Hidratação, cauterização e outros tratamentos para manter seu cabelo saudável.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="fixed inset-0 bg-navy text-white transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="p-6 space-y-6 slide-in">
      <button onclick="toggleMobileMenu()" class="mb-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
      <nav class="flex flex-col space-y-4">
        <a href="login.php" class="text-lg">Login</a>
        <a href="servicosdisponiveis.php" class="text-lg">Serviços</a>
        <a href="formAvaliaçao.php" class="text-lg">Aval
</div>
  </div>
</body>

</html>
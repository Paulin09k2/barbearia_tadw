<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbearia Elite</title>
  <link rel="shortcut icon" href="logo.png" type="image/png">
  <style>
    /* ======= RESET E BASE ======= */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(180deg, #0d1117, #0b1623);
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* ======= CABEÇALHO ======= */
    header {
      width: 100%;
      background-color: #0d1b2a;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 60px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.3);
      position: fixed;
      top: 0;
      z-index: 10;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }

    .logo span {
      font-size: 1.4rem;
      font-weight: 600;
      color: #fff;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      margin-left: 25px;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    nav a:hover {
      color: #d9a13b;
    }

    /* ======= CONTEÚDO PRINCIPAL ======= */
    main {
      margin-top: 25vh;
      text-align: center;
    }

    h1 {
      font-size: 3rem;
      font-weight: 700;
      background: rgba(0, 0, 0, 0.5);
      padding: 15px 30px;
      border-radius: 10px;
      display: inline-block;
    }

    p {
      background: rgba(0, 0, 0, 0.5);
      display: inline-block;
      padding: 10px 20px;
      border-radius: 10px;
      margin-top: 20px;
      font-size: 1.2rem;
    }

    .btn-agendar {
      display: inline-block;
      background-color: #142c44;
      color: #fff;
      margin-top: 30px;
      padding: 12px 25px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.3s ease;
    }

    .btn-agendar:hover {
      background-color: #d9a13b;
      color: #000;
    }

  </style>
</head>
<body>

  <!-- ======= CABEÇALHO ======= -->
  <header>
    <div class="logo">
      <img src="logo.png" alt="Logo Barbearia Elite">
      <span>Barbearia Elite</span>
    </div>

    <nav>
      <a href="#">Início</a>
      <a href="#">Agendamento</a>
      <a href="avaliacaocliente.php">Avaliação</a>
      <a href="servicoscliente.php">Serviços</a>
      <a href="login.php">Login</a>
    </nav>
  </header>

  <!-- ======= CONTEÚDO PRINCIPAL ======= -->
  <main>
    <h1>Bem-vindo à Barbearia Elite</h1>
    <br><p>Estilo clássico com atitude moderna</p><br>
    <a href="login.php" class="btn-agendar">Agende seu horário</a><br>
  </main>

</body>
</html>

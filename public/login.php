<?php
require_once "./conexao.php";
require_once "./funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Barbearia Elite</title>
  <link rel="icon" type="image/png" href="logo.png">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #060b11, #0f1f33);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      display: flex;
      align-items: center;
      gap: 60px;
      padding: 40px;
    }

    .logo img {
      height: 400px;
    }

    .login-box {
      background-color: #0f1f33;
      padding: 40px;
      border-radius: 25px;
      width: 350px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .login-box h2 {
      color: #d7d3cc;
      margin-bottom: 30px;
      font-size: 24px;
    }

    .login-box input {
      width: 100%;
      padding: 15px;
      border-radius: 30px;
      border: none;
      margin-bottom: 20px;
      font-size: 16px;
      background-color: #d7d3cc;
    }

    /* Botão centralizado */
    .login-box button {
      padding: 12px 120px;
      border-radius: 30px;
      border: none;
      background-color: #666;
      color: white;
      font-weight: bold;
      font-size: 20px;
      cursor: pointer;
      display: block;
      margin: 10px auto 0;
      /* centraliza horizontalmente */
    }

    .forgot {
      margin-top: 10px;
      font-size: 14px;
      color: rgb(200, 200, 200);
      text-decoration: none;
      text-align: center;
      display: block;
    }

    .forgot:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="logo">
      <img src="logo.png" alt="Logo Barbearia Elite">
    </div>

    <div class="login-box">
      <h2>Login</h2>

      <form action="verificarLogin.php" method="post">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Acessar</button>

        <a class="forgot" href="formCliente.php">Primeiro acesso</a>
        <a class="forgot" href="index.php">Sair</a>
      </form>
    </div>
  </div>
</body>

</html>
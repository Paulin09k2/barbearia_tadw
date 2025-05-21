<?php
// Este arquivo combina HTML, CSS e PHP
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbearia Elite</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: url('barber-pole-bg.jpg') no-repeat center center fixed;
      background-size: cover;
      color: white;
    }
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    .logo {
      background-color: black;
      padding: 20px;
      border-radius: 20px;
      text-align: center;
      margin-bottom: 40px;
    }
    .logo h1 {
      font-size: 28px;
      margin: 0;
      color: white;
    }
    .btn {
      background-color: #0a2342;
      border: 3px solid gold;
      color: gold;
      padding: 10px 30px;
      margin: 10px;
      border-radius: 20px;
      font-size: 16px;
      cursor: pointer;
      width: 200px;
    }
    .btn:hover {
      background-color: #163d5c;
    }
    .form-input {
      background-color: #0a2342;
      color: gold;
      border: none;
      border-radius: 20px;
      padding: 10px;
      margin: 10px;
      width: 250px;
      text-align: center;
    }
    .hidden {
      display: none;
    }
    .title {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 20px;
      color: gold;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <h1>Barbearia ELITE</h1>
    </div>
    <?php if (!isset($_POST['action'])): ?>
      <form method="post">
        <button class="btn" name="action" value="login">Entrar</button>
        <button class="btn" name="action" value="cadastro">Cadastrar</button>
        <button class="btn" name="action" value="barbeiro">Barbeiro</button>
      </form>
    <?php elseif ($_POST['action'] == 'login'): ?>
      <h2 class="title">Login</h2>
      <form method="post">
        <input type="text" name="usuario" class="form-input" placeholder="Email ou telefone">
        <input type="password" name="senha" class="form-input" placeholder="Senha">
        <button class="btn">Entrar</button>
        <button class="btn" type="submit" name="action" value="home">Voltar</button>
      </form>
    <?php elseif ($_POST['action'] == 'cadastro'): ?>
      <h2 class="title">Cadastro</h2>
      <form method="post">
        <input type="text" name="endereco" class="form-input" placeholder="Endereço">
        <input type="text" name="nome" class="form-input" placeholder="Nome Completo">
        <input type="password" name="senha" class="form-input" placeholder="Senha">
        <input type="date" name="nascimento" class="form-input">
        <input type="email" name="email" class="form-input" placeholder="Email">
        <input type="tel" name="telefone" class="form-input" placeholder="Telefone">
        <button class="btn">Cadastrar</button>
        <button class="btn" type="submit" name="action" value="home">Voltar</button>
      </form>
    <?php elseif ($_POST['action'] == 'barbeiro'): ?>
      <h2 class="title">Menu do Barbeiro</h2>
      <form method="post">
        <button class="btn" name="action" value="avaliacao">Avaliação</button>
        <button class="btn" name="action" value="agendamento">Agendamento</button>
        <button class="btn" name="action" value="historico">Histórico</button>
        <button class="btn" type="submit" name="action" value="home">Voltar</button>
      </form>
    <?php else: ?>
      <p>Ação desconhecida.</p>
      <form method="post">
        <button class="btn" type="submit" name="action" value="home">Voltar</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
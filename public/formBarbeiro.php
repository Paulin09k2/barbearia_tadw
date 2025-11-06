<?php
require_once "./conexao.php";
require_once "./funcoes.php";
session_start();

$idusuario = $_SESSION['idusuario'] ?? null;
$id = isset($_GET['id']) ? $_GET['id'] : $idusuario;

$barbeiro = pesquisarBarbeiroId($conexao, $id);
$usuario = pesquisarUsuarioId($conexao, $id);

if ($barbeiro && $usuario) {
    $id = $barbeiro['id_barbeiro'];
    $idusuario = $usuario['idusuario'];
    $nome = $barbeiro['nome'];
    $email = $usuario['email'];
    $telefone = $barbeiro['telefone'];
    $cpf = $barbeiro['cpf'];
    $data_nascimento = $barbeiro['data_nascimento'];
    $data_admissao = $barbeiro['data_admissao'];
    $senha_cliente = "";
    $botao = "Editar";
} else {
    $id = 0;
    $nome = "";
    $email = "";
    $telefone = "";
    $cpf = "";
    $data_nascimento = "";
    $data_admissao = date('Y-m-d');
    $senha_cliente = "";
    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="logo2.png">
  <title><?php echo $botao ?> Barbeiro</title>

  <style>
    /* ======= ESTILO GERAL ======= */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0a0a14, #1b1b2f);
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    h1 {
      margin-top: 40px;
      color: #f5b100;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-align: center;
    }

    form {
      background-color: #111827;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
      width: 90%;
      max-width: 500px;
      margin-top: 30px;
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: bold;
      color: #f5b100;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"] {
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: 1px solid #333;
      background-color: #1e293b;
      color: #fff;
      font-size: 1em;
      outline: none;
      transition: 0.3s;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    input[type="date"]:focus {
      border-color: #f5b100;
      box-shadow: 0 0 8px #f5b100;
    }

    input[type="submit"] {
      background-color: #f5b100;
      color: #111;
      font-weight: bold;
      font-size: 1em;
      padding: 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #fff;
      color: #111;
    }

    a {
      color: #f5b100;
      text-decoration: none;
      margin-top: 20px;
      transition: 0.3s;
    }

    a:hover {
      color: #fff;
      text-decoration: underline;
    }

    /* ======= RESPONSIVO ======= */
    @media (max-width: 600px) {
      form {
        padding: 25px;
      }

      input {
        font-size: 0.95em;
      }
    }
  </style>
</head>

<body>
  <h1><?php echo $botao ?> Barbeiro</h1>

  <form action="salvarBarbeiro.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

    <label for="telefone">Telefone:</label>
    <input type="text" id="telefone" name="telefone" value="<?php echo $telefone; ?>" required>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>" maxlength="11" required>

    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required max="<?= date('Y-m-d') ?>">

    <label for="data">Data de Admissão:</label>
    <input type="date" id="data" name="data" value="<?php echo $data_admissao; ?>" required>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>

    <input type="submit" value="<?php echo $botao; ?>">
  </form>

  <a href="./index.php">← Voltar ao Painel do Admin</a>
</body>
</html>

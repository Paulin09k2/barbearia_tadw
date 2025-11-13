<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "../conexao.php";

// Inclui funções auxiliares (como pesquisarBarbeiroId, etc.)
require_once "../funcoes.php";

// Inicia a sessão para acessar o ID do usuário logado
session_start();

// Pega o ID do usuário logado na sessão, se existir
$idusuario_session = $_SESSION['idusuario'] ?? null;

// Caso o admin acesse com ?id=..., usa o ID da URL, senão o da sessão
$param_idusuario = isset($_GET['id']) ? $_GET['id'] : $idusuario_session;

// Inicializa variáveis
$barbeiro = null;
$usuario = null;

// Se houver um ID válido, busca os dados do barbeiro e do usuário
if ($param_idusuario !== null && $param_idusuario !== '') {
  $barbeiro = pesquisarBarbeiroId($conexao, $param_idusuario);
  $usuario = pesquisarUsuarioId($conexao, $param_idusuario);
}

// Se encontrou dados no banco, entra em modo de edição
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
  // Caso contrário, entra em modo de cadastro
  $id = 0;
  $idusuario = "";
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
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Inter", system-ui, sans-serif;
    }

    body {
      background-color: #0f1724;
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      min-height: 100vh;
      padding: 40px 20px;
    }

    h1 {
      font-size: 22px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #fff;
      margin-bottom: 25px;
      text-align: center;
    }

    form {
      background-color: #121a23;
      width: 100%;
      max-width: 450px;
      padding: 40px 32px;
      border-radius: 12px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
      display: flex;
      flex-direction: column;
    }

    label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 6px;
      color: #fff;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #2b3440;
      border-radius: 6px;
      background-color: #1c2530;
      color: #fff;
      font-size: 14px;
      margin-bottom: 18px;
      transition: 0.2s;
    }

    input:focus {
      border-color: #ffcd00;
      outline: none;
      background-color: #202b36;
    }

    input[type="submit"] {
      width: 100%;
      background-color: #fff;
      border: none;
      color: #000;
      font-weight: 700;
      padding: 12px 0;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
      font-size: 15px;
      margin-top: 10px;
    }

    input[type="submit"]:hover {
      background-color: #ffcd00;
      color: #000;
    }

    a {
      display: inline-block;
      margin-top: 18px;
      color: #fff;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: 0.2s;
      text-align: center;
    }

    a:hover {
      text-decoration: underline;
      color: #ffcd00;
    }

    /* ======= RESPONSIVO ======= */
    @media (max-width: 500px) {
      form {
        padding: 30px 20px;
      }

      h1 {
        font-size: 18px;
      }

      input,
      button {
        font-size: 13.5px;
      }
    }
  </style>
</head>

<body>
  <h1><?php echo $botao ?> Barbeiro</h1>

  <!-- Formulário que envia para salvarBarbeiro.php -->
  <form action="../salvarBarbeiro.php" method="post" enctype="multipart/form-data">
    <!-- Campos ocultos com IDs -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">

    <!-- Nome -->
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>

    <!-- Email -->
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

    <!-- Telefone -->
    <label for="telefone">Telefone:</label>
    <input type="text" id="telefone" name="telefone" value="<?php echo $telefone; ?>" required>

    <!-- CPF -->
    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>" maxlength="11" required>

    <!-- Data de nascimento -->
    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required max="<?= date('Y-m-d') ?>">

    <!-- Data de admissão -->
    <label for="data">Data de Admissão:</label>
    <input type="date" id="data" name="data" value="<?php echo $data_admissao; ?>" required>

    <!-- Senha -->
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" placeholder="Digite nova senha se quiser alterar">

    <!-- Botão -->
    <input type="submit" value="<?php echo $botao; ?>">
  </form>

  <a href="admin/index.php">← Voltar ao Painel do Admin</a>
</body>
</html>

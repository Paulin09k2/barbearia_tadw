<?php
require_once "../conexao.php";
require_once "../funcoes.php";
session_start();

// Se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_servico = trim($_POST["nome_servico"]);
    $descricao = trim($_POST["descricao"]);
    $preco = floatval($_POST["preco"]);
    $tempo_estimado = intval($_POST["tempo_estimado"]);

    if (!empty($nome_servico) && $preco > 0 && $tempo_estimado > 0) {
        $resultado = salvarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado);

        if ($resultado) {
            $_SESSION['mensagem'] = "Serviço cadastrado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar o serviço. Tente novamente.";
        }
    } else {
        $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios corretamente.";
    }

    header("Location: adicionarServico.php");
    exit;
}

if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Serviço</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Inter", system-ui, sans-serif;
    }

    body {
      background-color: #0f141b;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      background-color: #121a23;
      width: 100%;
      max-width: 420px;
      padding: 40px 32px;
      border-radius: 12px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
    }

    h1 {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 25px;
      text-align: left;
      color: #fff;
    }

    label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 6px;
      color: #ccc;
    }

    input[type="text"],
    input[type="number"],
    textarea {
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

    input:focus,
    textarea:focus {
      border-color: #ffcd00;
      outline: none;
      background-color: #202b36;
    }

    textarea {
      resize: vertical;
      min-height: 90px;
    }

    button[type="submit"] {
      width: 100%;
      background-color: #ffcd00;
      border: none;
      color: #000;
      font-weight: 700;
      padding: 12px 0;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
      font-size: 15px;
    }

    button[type="submit"]:hover {
      background-color: #ffd633;
    }

    a {
      display: inline-block;
      margin-bottom: 18px;
      color: #ffcd00;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: 0.2s;
    }

    a:hover {
      text-decoration: underline;
    }

    @media (max-width: 500px) {
      .container {
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Adicionar Serviço</h1>
    <a href="index.php">← Voltar ao Painel</a>

    <form action="" method="POST">
      <label for="nome_servico">Nome do Serviço</label>
      <input type="text" id="nome_servico" name="nome_servico" placeholder="Ex: Corte masculino" required>

      <label for="descricao">Descrição</label>
      <textarea id="descricao" name="descricao" placeholder="Descreva o serviço..." required></textarea>

      <label for="preco">Preço (R$)</label>
      <input type="number" step="0.01" id="preco" name="preco" placeholder="Ex: 30.00" required>

      <label for="tempo_estimado">Tempo Estimado (minutos)</label>
      <input type="number" id="tempo_estimado" name="tempo_estimado" placeholder="Ex: 45" required>

      <button type="submit">Cadastrar Serviço</button>
    </form>
  </div>
</body>
</html>

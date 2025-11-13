<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "../conexao.php";

// Inclui funções auxiliares (como salvarServico)
require_once "../funcoes.php";

// Inicia a sessão para usar variáveis de sessão (mensagens, usuário logado, etc.)
session_start();

// Verifica se o formulário foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtém e remove espaços extras do nome do serviço
    $nome_servico = trim($_POST["nome_servico"]);
    // Obtém e remove espaços extras da descrição
    $descricao = trim($_POST["descricao"]);
    // Converte o preço informado para número decimal (float)
    $preco = floatval($_POST["preco"]);
    // Converte o tempo estimado para número inteiro
    $tempo_estimado = intval($_POST["tempo_estimado"]);

    // Verifica se todos os campos obrigatórios foram preenchidos corretamente
    if (!empty($nome_servico) && $preco > 0 && $tempo_estimado > 0) {
        // Chama a função para salvar o serviço no banco de dados
        $resultado = salvarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado);

        // Se o cadastro for bem-sucedido
        if ($resultado) {
            $_SESSION['mensagem'] = "Serviço cadastrado com sucesso!";
        } else {
            // Se ocorrer erro ao salvar
            $_SESSION['mensagem'] = "Erro ao cadastrar o serviço. Tente novamente.";
        }
    } else {
        // Caso algum campo esteja vazio ou inválido
        $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios corretamente.";
    }

    // Redireciona o usuário para a mesma página após o envio
    header("Location: adicionarServico.php");
    exit;
}

// Se houver mensagem de sessão, exibe-a em um alerta e depois remove
if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <!-- Define a codificação de caracteres -->
  <meta charset="UTF-8">
  <!-- Define o comportamento responsivo da página -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Título da aba do navegador -->
  <title>Adicionar Serviço</title>

  <style>
    /* Remove margens e paddings padrão e define fonte base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Inter", system-ui, sans-serif;
    }

    /* Define o fundo e centraliza o conteúdo */
    body {
      background-color: #0f141b;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    /* Container principal do formulário */
    .container {
      background-color: #121a23;
      width: 100%;
      max-width: 420px;
      padding: 40px 32px;
      border-radius: 12px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
    }

    /* Título da página */
    h1 {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 25px;
      text-align: left;
      color: #fff;
    }

    /* Estilo dos rótulos dos campos */
    label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 6px;
      color: #ccc;
    }

    /* Estilo dos campos de texto, número e textarea */
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

    /* Efeito de foco nos campos */
    input:focus,
    textarea:focus {
      border-color: #ffcd00;
      outline: none;
      background-color: #202b36;
    }

    /* Permite redimensionar o campo de texto verticalmente */
    textarea {
      resize: vertical;
      min-height: 90px;
    }

    /* Botão de envio */
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

    /* Efeito ao passar o mouse no botão */
    button[type="submit"]:hover {
      background-color: #ffd633;
    }

    /* Link de voltar ao painel */
    a {
      display: inline-block;
      margin-bottom: 18px;
      color: #ffcd00;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: 0.2s;
    }

    /* Efeito de hover no link */
    a:hover {
      text-decoration: underline;
    }

    /* Ajuste de padding em telas pequenas */
    @media (max-width: 500px) {
      .container {
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>
  <!-- Container do formulário -->
  <div class="container">
    <!-- Título principal -->
    <h1>Adicionar Serviço</h1>
    <!-- Link de retorno ao painel administrativo -->
    <a href="index.php">← Voltar ao Painel</a>

    <!-- Formulário de cadastro de serviço -->
    <form action="" method="POST">
      <!-- Campo de nome do serviço -->
      <label for="nome_servico">Nome do Serviço</label>
      <input type="text" id="nome_servico" name="nome_servico" placeholder="Ex: Corte masculino" required>

      <!-- Campo de descrição -->
      <label for="descricao">Descrição</label>
      <textarea id="descricao" name="descricao" placeholder="Descreva o serviço..." required></textarea>

      <!-- Campo de preço -->
      <label for="preco">Preço (R$)</label>
      <input type="number" step="0.01" id="preco" name="preco" placeholder="Ex: 30.00" required>

      <!-- Campo de tempo estimado -->
      <label for="tempo_estimado">Tempo Estimado (minutos)</label>
      <input type="number" id="tempo_estimado" name="tempo_estimado" placeholder="Ex: 45" required>

      <!-- Botão de envio -->
      <button type="submit">Cadastrar Serviço</button>
    </form>
  </div>
</body>
</html>
